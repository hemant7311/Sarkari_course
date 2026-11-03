<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'teacher_name',
        'category',
        'level',
        'price',
        'thumbnail',
        'description',
        'status',
    ];

    /**
     * Full public URL to the thumbnail image, or null if none set.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? asset('storage/'.$this->thumbnail) : null;
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('sort_order');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')->withPivot('progress', 'enrolled_at')->withTimestamps();
    }

    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    public function mockTests()
    {
        return $this->hasMany(MockTest::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function isEnrolledBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->enrollments()->where('user_id', $user->id)->exists();
    }
}
