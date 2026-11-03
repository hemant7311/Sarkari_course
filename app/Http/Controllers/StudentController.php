<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\UserNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function wishlist(Request $request): View
    {
        $wishlistCourses = $request->user()->wishlistCourses()->active()->latest('wishlists.created_at')->get();

        return view('user.wishlist', compact('wishlistCourses'));
    }

    public function toggleWishlist(Request $request, Course $course): RedirectResponse
    {
        abort_unless($course->status === 'Active', 404);
        $attached = $request->user()->wishlistCourses()->toggle($course->id);
        $added = in_array($course->id, $attached['attached'], true);

        return back()->with('status', $added ? 'Course wishlist mein save ho gaya.' : 'Course wishlist se remove ho gaya.');
    }

    public function notifications(Request $request): View
    {
        $notifications = $request->user()->notifications()->latest()->paginate(20);

        return view('user.notifications', compact('notifications'));
    }

    public function markAllNotificationsRead(Request $request): RedirectResponse
    {
        $request->user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return back()->with('status', 'All notifications marked as read.');
    }

    public function markNotificationRead(Request $request, UserNotification $notification): RedirectResponse
    {
        abort_unless($notification->user_id === $request->user()->id, 403);
        $notification->update(['read_at' => now()]);

        return redirect($notification->action_url ?: route('notifications'));
    }

    public function updatePreferences(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'notification_preferences' => ['nullable', 'array'],
            'notification_preferences.*' => ['boolean'],
            'language' => ['nullable', 'in:en,hi'],
            'theme' => ['nullable', 'in:light,dark,system'],
        ]);

        $request->user()->preference()->updateOrCreate([], [
            'notification_preferences' => $validated['notification_preferences'] ?? [],
            'language' => $validated['language'] ?? 'en',
            'theme' => $validated['theme'] ?? 'system',
        ]);

        return back()->with('status', 'settings-updated');
    }

    public function certificate(Request $request, Certificate $certificate): View
    {
        abort_unless($certificate->user_id === $request->user()->id, 403);
        $certificate->load(['course', 'user']);

        return view('certificates.show', compact('certificate'));
    }

    public function verifyCertificate(string $verificationCode): View
    {
        $certificate = Certificate::where('verification_code', $verificationCode)->with(['course', 'user'])->firstOrFail();

        return view('certificates.verify', compact('certificate'));
    }
}
