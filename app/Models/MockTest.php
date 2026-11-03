<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTest extends Model
{
    protected $fillable = ['course_id', 'title', 'description', 'duration_minutes', 'passing_score', 'is_published'];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(MockTestQuestion::class)->orderBy('sort_order');
    }

    public function attempts()
    {
        return $this->hasMany(MockTestAttempt::class);
    }
}
