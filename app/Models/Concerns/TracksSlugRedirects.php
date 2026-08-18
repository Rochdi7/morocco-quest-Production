<?php

namespace App\Models\Concerns;

use App\Models\SlugRedirect;
use Illuminate\Support\Str;

trait TracksSlugRedirects
{
    protected static function bootTracksSlugRedirects(): void
    {
        static::updated(function ($model) {
            if (! $model->wasChanged('slug')) {
                return;
            }

            $oldSlug = $model->getOriginal('slug');
            $newSlug = $model->slug;

            if (! $oldSlug || ! $newSlug || $oldSlug === $newSlug) {
                return;
            }

            $oldPath = $model->seoPathForSlug($oldSlug);
            $newPath = $model->seoPathForSlug($newSlug);

            if ($oldPath === $newPath) {
                return;
            }

            SlugRedirect::query()->updateOrCreate(
                ['old_path' => $oldPath],
                [
                    'new_path' => $newPath,
                    'redirectable_type' => $model::class,
                    'redirectable_id' => $model->getKey(),
                ]
            );

            SlugRedirect::query()
                ->where('new_path', $oldPath)
                ->where('redirectable_type', $model::class)
                ->where('redirectable_id', $model->getKey())
                ->update(['new_path' => $newPath]);
        });
    }

    public function seoPathForSlug(string $slug): string
    {
        return '/' . trim(static::seoPathPrefix(), '/') . '/' . Str::slug($slug);
    }

    public static function seoPathPrefix(): string
    {
        return trim((string) (static::$seoPathPrefix ?? ''), '/');
    }
}
