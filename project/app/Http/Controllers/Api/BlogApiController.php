<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\YoutubeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogApiController extends Controller
{
    /**
     * GET /api/blog/posts
     * Backend-driven blog list — supports ?search=&category=&page=
     */
    public function posts(Request $request): JsonResponse
    {
        $query = Blog::query()->published()->latest('published_at');

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $paginator = $query->paginate(9)->withQueryString();

        $data = collect($paginator->items())->map(function (Blog $post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'excerpt' => $post->excerpt ?: Str::limit(strip_tags($post->content), 130),
                'thumbnail' => $post->thumbnail_url ?? 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=700&q=80',
                'category' => $post->category,
                'published_at' => optional($post->published_at)->format('M d, Y'),
                'url' => route('blog.show', $post),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'has_more' => $paginator->hasMorePages(),
                'next_page_url' => $paginator->nextPageUrl(),
            ],
        ]);
    }

    /**
     * GET /api/blog/categories
     */
    public function categories(): JsonResponse
    {
        $categories = Blog::published()->whereNotNull('category')->distinct()->pluck('category');

        return response()->json(['success' => true, 'data' => $categories]);
    }

    /**
     * GET /api/blog/videos
     * Backend-driven YouTube videos list (fetched server-side from the YouTube Data API,
     * cached, and reshaped into JSON the frontend can render — no client-side calls to
     * Google's API and no API key exposed to the browser).
     */
    public function videos(YoutubeService $youtube): JsonResponse
    {
        try {
            $videos = $youtube->latestVideos(12);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'YouTube videos abhi load nahi ho paaye. Thodi der baad try karein.',
            ], 502);
        }

        $data = collect($videos)->map(function (array $video) {
            return [
                'video_id' => $video['video_id'],
                'title' => $video['title'],
                'description' => Str::limit(strip_tags($video['description'] ?? ''), 130),
                'thumbnail' => $video['thumbnail'],
                'published_at' => $video['published_at'] ? \Illuminate\Support\Carbon::parse($video['published_at'])->format('M d, Y') : null,
                'watch_url' => $video['url'],
                'embed_url' => 'https://www.youtube-nocookie.com/embed/'.$video['video_id'].'?autoplay=1&rel=0',
            ];
        });

        return response()->json(['success' => true, 'data' => $data]);
    }
}