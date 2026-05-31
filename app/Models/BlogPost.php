<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'user_id', 'blog_category_id', 'title', 'slug', 'excerpt',
        'content', 'featured_image', 'status', 'meta_title',
        'meta_description', 'published_at',
    ];

    protected $casts = ['published_at' => 'datetime'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at');
    }

    public function pageViews()
    {
        return $this->morphMany(PageView::class, 'viewable');
    }

    public function getReadingTimeAttribute(): string
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = max(1, ceil($words / 200));
        return $minutes . ' min read';
    }
}
