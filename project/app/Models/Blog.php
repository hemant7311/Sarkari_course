<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'category',
        'thumbnail',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Blog $blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title).'-'.Str::random(5);
            }

            if ($blog->status === 'Published' && empty($blog->published_at)) {
                $blog->published_at = now();
            }
        });

        static::updating(function (Blog $blog) {
            if ($blog->isDirty('status') && $blog->status === 'Published' && empty($blog->published_at)) {
                $blog->published_at = now();
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'Published')->where('published_at', '<=', now());
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? asset('storage/'.$this->thumbnail) : null;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
