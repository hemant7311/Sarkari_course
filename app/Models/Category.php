<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Courses that belong to this category (matched by name).
     */
    public function courses()
    {
        return Course::where('category', $this->name);
    }

    /**
     * Number of active courses in this category.
     */
    public function getCoursesCountAttribute(): int
    {
        return Course::where('category', $this->name)->where('status', 'Active')->count();
    }
}
