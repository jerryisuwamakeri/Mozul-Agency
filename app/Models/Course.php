<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'content', 'cover_image',
        'price', 'currency', 'status', 'duration', 'level',
        'category', 'enrollment_url', 'order',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeVisible($query)
    {
        return $query->whereIn('status', ['published', 'coming_soon']);
    }

    public function getIsFreeAttribute(): bool
    {
        return is_null($this->price) || $this->price == 0;
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->is_free) return 'Free';
        return number_format($this->price, 0) . ' ' . $this->currency;
    }

    public function getLevelLabelAttribute(): string
    {
        return match($this->level) {
            'beginner'     => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced'     => 'Advanced',
            default        => '',
        };
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }
}
