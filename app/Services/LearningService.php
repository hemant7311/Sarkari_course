<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\Chapter;
use App\Models\ChapterCompletion;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Support\Str;

class LearningService
{
    /**
     * Record a completed lesson and keep the enrollment percentage authoritative.
     */
    public function completeChapter(User $user, Chapter $chapter): Enrollment
    {
        $enrollment = Enrollment::query()
            ->where('user_id', $user->id)
            ->where('course_id', $chapter->course_id)
            ->firstOrFail();

        ChapterCompletion::firstOrCreate([
            'user_id' => $user->id,
            'chapter_id' => $chapter->id,
        ], ['completed_at' => now()]);

        $chapterIds = $chapter->course->chapters()->pluck('id');
        $total = $chapterIds->count();
        $completed = ChapterCompletion::query()
            ->where('user_id', $user->id)
            ->whereIn('chapter_id', $chapterIds)
            ->count();

        $progress = $total === 0 ? 0 : (int) round(($completed / $total) * 100);
        $enrollment->update(['progress' => min($progress, 100)]);

        if ($enrollment->progress === 100) {
            $certificate = Certificate::firstOrCreate(
                ['user_id' => $user->id, 'course_id' => $chapter->course_id],
                ['verification_code' => (string) Str::uuid(), 'issued_at' => now()]
            );

            if ($certificate->wasRecentlyCreated) {
                UserNotification::create([
                    'user_id' => $user->id,
                    'type' => 'certificate',
                    'title' => 'Course completed',
                    'body' => 'Your certificate for '.$chapter->course->title.' is ready.',
                    'action_url' => route('certificates.show', $certificate),
                ]);
            }
        }

        return $enrollment->fresh();
    }
}
