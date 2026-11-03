<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Show the admin "Add Courses" page with the existing course list.
     */
    public function index(): View
    {
        $courses = Course::latest()->paginate(10);
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('admin.addcourses', compact('courses', 'categories'));
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCourse($request);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        Course::create($validated);

        return redirect()->route('addcourses')->with('status', 'Course added successfully.');
    }

    /**
     * Update an existing course.
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        $validated = $this->validateCourse($request);

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('addcourses')->with('status', 'Course updated successfully.');
    }

    /**
     * Remove a course.
     */
    public function destroy(Course $course): RedirectResponse
    {
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('addcourses')->with('status', 'Course deleted successfully.');
    }

    /**
     * Shared validation rules for store/update.
     */
    private function validateCourse(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'teacher_name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'level' => ['required', 'string', 'max:50'],
            'price' => ['required', 'integer', 'min:0'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'in:Active,Inactive'],
        ]);
    }
}
