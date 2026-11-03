<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\UserNotification;
use App\Services\LearningService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StudentApiController extends Controller
{
    public function profile(Request $request): JsonResponse
    {
        return response()->json(['success' => true, 'data' => $this->userData($request->user())]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);
        $emailChanged = $validated['email'] !== $user->email;
        $user->fill($validated);
        if ($emailChanged) {
            $user->email_verified_at = null;
        }
        $user->save();

        return response()->json(['success' => true, 'data' => $this->userData($user->fresh())]);
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $request->user()->update(['password' => Hash::make($validated['password'])]);

        return response()->json(['success' => true, 'message' => 'Password updated successfully.']);
    }

    public function wishlist(Request $request): JsonResponse
    {
        $courses = $request->user()->wishlistCourses()->active()->latest('wishlists.created_at')->get();

        return response()->json(['success' => true, 'data' => $courses->map(fn (Course $course) => $this->courseData($course))]);
    }

    public function toggleWishlist(Request $request, Course $course): JsonResponse
    {
        abort_unless($course->status === 'Active', 404);
        $result = $request->user()->wishlistCourses()->toggle($course->id);
        $saved = in_array($course->id, $result['attached'], true);

        return response()->json(['success' => true, 'data' => ['saved' => $saved]]);
    }

    public function notifications(Request $request): JsonResponse
    {
        $items = $request->user()->notifications()->latest()->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $items->getCollection()->map(fn (UserNotification $notification) => $this->notificationData($notification)),
            'meta' => ['current_page' => $items->currentPage(), 'last_page' => $items->lastPage(), 'total' => $items->total()],
        ]);
    }

    public function markNotificationRead(Request $request, UserNotification $notification): JsonResponse
    {
        abort_unless($notification->user_id === $request->user()->id, 403);
        $notification->update(['read_at' => now()]);

        return response()->json(['success' => true, 'data' => $this->notificationData($notification->fresh())]);
    }

    public function markAllNotificationsRead(Request $request): JsonResponse
    {
        $request->user()->notifications()->whereNull('read_at')->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function updatePreferences(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'notification_preferences' => ['nullable', 'array'],
            'notification_preferences.*' => ['boolean'],
            'language' => ['nullable', 'in:en,hi'],
            'theme' => ['nullable', 'in:light,dark,system'],
        ]);
        $preference = $request->user()->preference()->updateOrCreate([], [
            'notification_preferences' => $validated['notification_preferences'] ?? [],
            'language' => $validated['language'] ?? 'en',
            'theme' => $validated['theme'] ?? 'system',
        ]);

        return response()->json(['success' => true, 'data' => $preference]);
    }

    public function completeChapter(Request $request, \App\Models\Chapter $chapter, LearningService $learning): JsonResponse
    {
        $enrollment = $learning->completeChapter($request->user(), $chapter);

        return response()->json(['success' => true, 'data' => ['progress' => $enrollment->progress]]);
    }

    public function certificates(Request $request): JsonResponse
    {
        $items = $request->user()->certificates()->with('course')->latest('issued_at')->get();

        return response()->json(['success' => true, 'data' => $items->map(fn (Certificate $certificate) => $this->certificateData($certificate))]);
    }

    private function userData($user): array
    {
        $user->loadMissing('preference');
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'profile_image_url' => $user->profile_image_url,
            'email_verified_at' => optional($user->email_verified_at)->toIso8601String(),
            'preferences' => $user->preference,
        ];
    }

    private function courseData(Course $course): array
    {
        return ['id' => $course->id, 'title' => $course->title, 'category' => $course->category, 'thumbnail_url' => $course->thumbnail_url];
    }

    private function notificationData(UserNotification $notification): array
    {
        return ['id' => $notification->id, 'type' => $notification->type, 'title' => $notification->title, 'body' => $notification->body, 'action_url' => $notification->action_url, 'read_at' => optional($notification->read_at)->toIso8601String(), 'created_at' => $notification->created_at->toIso8601String()];
    }

    private function certificateData(Certificate $certificate): array
    {
        return ['id' => $certificate->id, 'course' => $certificate->course?->title, 'issued_at' => $certificate->issued_at->toIso8601String(), 'verification_code' => $certificate->verification_code, 'verification_url' => route('certificates.verify', $certificate->verification_code)];
    }
}
