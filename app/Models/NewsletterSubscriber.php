<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    protected $fillable = ['email', 'unsubscribe_token', 'unsubscribed_at'];

    protected function casts(): array
    {
        return ['unsubscribed_at' => 'datetime'];
    }

    protected static function booted(): void
    {
        static::creating(function (self $subscriber): void {
            $subscriber->unsubscribe_token ??= (string) Str::uuid();
        });
    }
}
