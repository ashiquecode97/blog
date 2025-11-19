<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
                
                // Ensure unique slug
                $count = static::where('slug', 'LIKE', "{$post->slug}%")->count();
                if ($count > 0) {
                    $post->slug = "{$post->slug}-" . ($count + 1);
                }
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return Str::limit(strip_tags($this->content), 150);
    }

    // Get full image URL
    public function getImageUrlAttribute()
    {
        if (!$this->featured_image) {
            return null;
        }

        // If it's a full URL, return as is
        if (str_starts_with($this->featured_image, 'http')) {
            return $this->featured_image;
        }

        // If it's a local path, return storage URL
        return asset('storage/' . $this->featured_image);
    }
}