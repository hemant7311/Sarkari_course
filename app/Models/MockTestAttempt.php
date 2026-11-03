<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTestAttempt extends Model
{
    protected $fillable = ['mock_test_id', 'user_id', 'answers', 'correct_answers', 'total_questions', 'score', 'started_at', 'submitted_at'];

    protected function casts(): array
    {
        return ['answers' => 'array', 'started_at' => 'datetime', 'submitted_at' => 'datetime'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mockTest()
    {
        return $this->belongsTo(MockTest::class);
    }
}
