<?php

namespace App\Support;

use Illuminate\Support\Str;

class MediaUrl
{
    public static function placeholder(): string
    {
        return asset('assets/img/placeholder-image.webp');
    }

    public static function resolve(?string $path, ?string $fallback = null): string
    {
        $fallback ??= self::placeholder();

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

        if (Str::startsWith($normalized, ['assets/', 'build/', 'css/', 'js/', 'public/'])) {
            return asset($normalized);
        }

        if (Str::startsWith($normalized, 'storage/')) {
            return asset($normalized);
        }

        return asset('storage/' . $normalized);
    }
}
