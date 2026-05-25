<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Support\MediaUrl;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'summary',
        'content',
        'quote',
        'quote_author',
        'written_by',
        'featured_image',
        'featured_image_alt',
        'featured_image_caption',
        'featured_image_description'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_category');
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag');
    }
    public function comments() // Comments for this blog post
    {
        return $this->hasMany(Comment::class); // Assuming Comment model is App\Models\Comment
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if (class_exists(MediaUrl::class)) {
            return MediaUrl::resolve($this->featured_image);
        }

        return self::resolveMediaUrlFallback($this->featured_image);
    }

    protected static function resolveMediaUrlFallback(?string $path, ?string $fallback = null): string
    {
        $fallback ??= asset('assets/img/placeholder-image.webp');

        if (! is_string($path) || trim($path) === '') {
            return $fallback;
        }

        $normalized = ltrim(str_replace('\\', '/', trim($path)), '/');

        if ($normalized === '') {
            return $fallback;
        }

        if (filter_var($normalized, FILTER_VALIDATE_URL)) {
            return $normalized;
        }

        foreach (['assets/', 'build/', 'css/', 'js/', 'public/'] as $prefix) {
            if (str_starts_with($normalized, $prefix)) {
                return asset($normalized);
            }
        }

        if (str_starts_with($normalized, 'storage/')) {
            return asset('public/' . $normalized);
        }

        return asset('public/storage/' . $normalized);
    }
}
