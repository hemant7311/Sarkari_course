<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChapterController extends Controller
{
    public function index(Course $course): View
    {
        $chapters = $course->chapters;

        return view('admin.chapters', compact('course', 'chapters'));
    }

    public function store(Request $request, Course $course): RedirectResponse
    {
        $validated = $this->validateChapter($request);
        $validated['course_id'] = $course->id;
        $validated['sort_order'] = $course->chapters()->max('sort_order') + 1;

        Chapter::create($validated);

        return redirect()->route('admin.chapters', $course)->with('status', 'Chapter add ho gaya.');
    }

    public function update(Request $request, Course $course, Chapter $chapter): RedirectResponse
    {
        $chapter->update($this->validateChapter($request));

        return redirect()->route('admin.chapters', $course)->with('status', 'Chapter update ho gaya.');
    }

    public function destroy(Course $course, Chapter $chapter): RedirectResponse
    {
        $chapter->delete();

        return redirect()->route('admin.chapters', $course)->with('status', 'Chapter delete ho gaya.');
    }

    private function validateChapter(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'video_url' => ['nullable', 'string', 'max:500'],
            'duration_minutes' => ['nullable', 'integer', 'min:0'],
            'is_preview' => ['nullable', 'boolean'],
        ]) + ['is_preview' => $request->boolean('is_preview')];
    }
}
