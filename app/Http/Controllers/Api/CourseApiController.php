<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseApiController extends Controller
{
    /**
     * GET /api/courses?category=&search=&page=
     */
    public function index(Request $request): JsonResponse
    {
        $query = Course::query()->active()->latest();

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('teacher_name', 'like', "%{$search}%");
            });
        }

        $paginator = $query->withCount('chapters')->paginate(9)->withQueryString();
        $user = $request->user('sanctum');

        $data = collect($paginator->items())->map(fn (Course $course) => $this->formatCourse($course, $user));

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'has_more' => $paginator->hasMorePages(),
                'next_page_url' => $paginator->nextPageUrl(),
                'total' => $paginator->total(),
            ],
        ]);
    }

    /**
     * GET /api/courses/{id}
     */
    public function show(Request $request, Course $course): JsonResponse
    {
        abort_unless($course->status === 'Active', 404);

        $course->load('chapters');
        $user = $request->user('sanctum');
        $isEnrolled = $course->isEnrolledBy($user);

        $relatedCourses = Course::active()
            ->where('category', $course->category)
            ->where('id', '!=', $course->id)
            ->take(4)
            ->get()
            ->map(fn (Course $c) => $this->formatCourse($c, $user));

        return response()->json([
            'success' => true,
            'data' => array_merge($this->formatCourse($course, $user, detailed: true), [
                'chapters' => $course->chapters->map(function ($chapter) use ($isEnrolled) {
                    $canWatch = $chapter->is_preview || $isEnrolled;

                    return [
                        'id' => $chapter->id,
                        'title' => $chapter->title,
                        'duration_minutes' => $chapter->duration_minutes,
                        'is_preview' => $chapter->is_preview,
                        'can_watch' => $canWatch,
                        'embed_url' => $canWatch ? $chapter->embed_url : null,
                    ];
                }),
                'related_courses' => $relatedCourses,
            ]),
        ]);
    }

    /**
     * GET /api/categories
     */
    public function categories(): JsonResponse
    {
        $categories = Category::orderBy('name')->get()->map(fn (Category $category) => [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'icon' => $category->icon,
            'courses_count' => $category->courses_count,
        ]);

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * POST /api/courses/{id}/enroll
     */
    public function enroll(Request $request, Course $course): JsonResponse
    {
        abort_unless($course->status === 'Active', 404);

        $user = $request->user();
        $alreadyEnrolled = $course->isEnrolledBy($user);

        if (! $alreadyEnrolled) {
            $course->enrollments()->create([
                'user_id' => $user->id,
                'enrolled_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Aap successfully "'.$course->title.'" course me enroll ho gaye hain.',
            'data' => ['is_enrolled' => true],
        ]);
    }

    /**
     * DELETE /api/courses/{id}/enroll
     */
    public function unenroll(Request $request, Course $course): JsonResponse
    {
        $course->enrollments()->where('user_id', $request->user()->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course aapke dashboard se remove kar diya gaya hai.',
            'data' => ['is_enrolled' => false],
        ]);
    }

    private function formatCourse(Course $course, $user = null, bool $detailed = false): array
    {
        $data = [
            'id' => $course->id,
            'title' => $course->title,
            'teacher_name' => $course->teacher_name,
            'category' => $course->category,
            'level' => $course->level,
            'price' => $course->price,
            'thumbnail_url' => $course->thumbnail_url ?? 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=700&q=80',
            'status' => $course->status,
            'is_enrolled' => $user ? $course->isEnrolledBy($user) : false,
            'chapters_count' => $course->chapters_count ?? $course->chapters()->count(),
        ];

        if ($detailed) {
            $data['description'] = $course->description;
        }

        return $data;
    }
}
