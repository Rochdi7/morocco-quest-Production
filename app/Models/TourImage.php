<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Support\MediaUrl;

class TourImage extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'image_path', 'caption', 'alt', 'description'];

    public function tour()
    {
        return $this->belongsTo(\App\Models\Tour::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (class_exists(MediaUrl::class)) {
            return MediaUrl::resolve($this->image_path);
        }

        return self::resolveMediaUrlFallback($this->image_path);
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
            return asset($normalized);
        }

        return asset('storage/' . $normalized);
    }
}
