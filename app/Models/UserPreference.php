<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = ['user_id', 'notification_preferences', 'language', 'theme'];

    protected function casts(): array
    {
        return ['notification_preferences' => 'array'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
