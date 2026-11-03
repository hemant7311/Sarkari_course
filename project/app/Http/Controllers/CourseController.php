<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Public course listing page with category filter.
     */
    public function index(Request $request): View
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

        $courses = $query->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('courses', compact('courses', 'categories'));
    }

    /**
     * Public single course details page.
     */
    public function show(Request $request, Course $course): View
    {
        $relatedCourses = Course::active()
            ->where('category', $course->category)
            ->where('id', '!=', $course->id)
            ->take(4)
            ->get();

        $isEnrolled = $course->isEnrolledBy($request->user());

        $firstPlayable = $course->chapters
            ->first(fn ($chapter) => ($chapter->is_preview || $isEnrolled) && $chapter->embed_url);

        return view('course_details', compact('course', 'relatedCourses', 'isEnrolled', 'firstPlayable'));
    }
}
