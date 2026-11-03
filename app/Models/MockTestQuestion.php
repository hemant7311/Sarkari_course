<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTestQuestion extends Model
{
    protected $fillable = ['mock_test_id', 'question', 'options', 'correct_option', 'explanation', 'sort_order'];

    protected function casts(): array
    {
        return ['options' => 'array'];
    }

    public function mockTest()
    {
        return $this->belongsTo(MockTest::class);
    }
}
