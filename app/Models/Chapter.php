<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'video_url',
        'duration_minutes',
        'sort_order',
        'is_preview',
    ];

    protected function casts(): array
    {
        return [
            'is_preview' => 'boolean',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function completions()
    {
        return $this->hasMany(ChapterCompletion::class);
    }

    /**
     * Convert a normal YouTube watch/share URL into an embeddable URL
     * so the video plays inline on our own site instead of redirecting
     * to youtube.com.
     */
    public function getEmbedUrlAttribute(): ?string
    {
        if (! $this->video_url) {
            return null;
        }

        if (str_contains($this->video_url, 'youtube.com/embed/')) {
            return $this->video_url;
        }

        if (preg_match('/(?:youtu\.be\/|v=)([A-Za-z0-9_-]{6,})/', $this->video_url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[1].'?rel=0&modestbranding=1';
        }

        return $this->video_url;
    }
}
