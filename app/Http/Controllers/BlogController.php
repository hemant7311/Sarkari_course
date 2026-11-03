<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Public blog listing page shell.
     * Posts and YouTube videos are fetched client-side from the JSON API
     * (see BlogApiController) so the Blogs / YouTube Blogs toggle never reloads the page.
     */
    public function index(): View
    {
        $categories = Blog::published()->whereNotNull('category')->distinct()->pluck('category');

        return view('blog', compact('categories'));
    }

    /**
     * Single blog post page.
     */
    public function show(Blog $blog): View
    {
        abort_unless($blog->status === 'Published', 404);

        $related = Blog::published()
            ->where('id', '!=', $blog->id)
            ->when($blog->category, fn ($q) => $q->where('category', $blog->category))
            ->take(3)
            ->get();

        return view('blog_details', compact('blog', 'related'));
    }
}