<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterCompletion extends Model
{
    protected $fillable = ['user_id', 'chapter_id', 'completed_at'];

    protected function casts(): array
    {
        return ['completed_at' => 'datetime'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
