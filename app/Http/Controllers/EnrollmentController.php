<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Enroll the current user into a course ("Add to Course" / "Enroll Free").
     */
    public function store(Request $request, Course $course): RedirectResponse
    {
        $user = $request->user();

        $alreadyEnrolled = $course->enrollments()->where('user_id', $user->id)->exists();

        if (! $alreadyEnrolled) {
            $course->enrollments()->create([
                'user_id' => $user->id,
                'enrolled_at' => now(),
            ]);
        }

        return back()->with('status', 'Aap successfully "'.$course->title.'" course me enroll ho gaye hain.');
    }

    /**
     * Remove the current user's enrollment from a course.
     */
    public function destroy(Request $request, Course $course): RedirectResponse
    {
        $course->enrollments()->where('user_id', $request->user()->id)->delete();

        return back()->with('status', 'Course aapke dashboard se remove kar diya gaya hai.');
    }
}
