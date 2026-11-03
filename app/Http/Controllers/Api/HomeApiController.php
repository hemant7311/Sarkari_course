<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class HomeApiController extends Controller
{
    /**
     * GET /api/home
     */
    public function home(): JsonResponse
    {
        $featuredCourses = Course::active()->latest()->take(6)->get()->map(fn (Course $course) => [
            'id' => $course->id,
            'title' => $course->title,
            'teacher_name' => $course->teacher_name,
            'category' => $course->category,
            'level' => $course->level,
            'price' => $course->price,
            'thumbnail_url' => $course->thumbnail_url ?? 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=700&q=80',
        ]);

        $categories = Category::orderBy('name')->get()->map(fn (Category $category) => [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'icon' => $category->icon,
            'courses_count' => $category->courses_count,
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'stats' => [
                    'total_students' => User::where('role', 'user')->count(),
                    'total_courses' => Course::active()->count(),
                ],
                'categories' => $categories,
                'featured_courses' => $featuredCourses,
            ],
        ]);
    }

    /**
     * GET /api/about
     */
    public function about(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'stats' => [
                    'total_students' => User::where('role', 'user')->count(),
                    'total_courses' => Course::active()->count(),
                ],
            ],
        ]);
    }
}
