<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'email',
        'phone',
        'address',
        'footer_text',
        'facebook',
        'instagram',
        'youtube',
    ];

    /**
     * Get the single settings row (creates default row if none exists).
     * Cached briefly so we're not querying this on every page load.
     */
    public static function current(): self
    {
        return Cache::remember('site_settings.current', now()->addMinutes(30), function () {
            return static::query()->firstOrCreate(['id' => 1]);
        });
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('site_settings.current'));
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/'.$this->logo) : null;
    }
}
