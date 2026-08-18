<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\ActivityImage; // For the images relationship
use App\Models\ActivityCategory; // For the category relationship
use App\Models\ItineraryDay; // <-- IMPORT THE ITINERARY DAY MODEL
use App\Models\Concerns\TracksSlugRedirects;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Support\MediaUrl;

class Activity extends Model
{
    use HasFactory;
    use TracksSlugRedirects;

    protected static string $seoPathPrefix = 'activities';

    public function places()
    {
        return $this->belongsToMany(Place::class, 'activity_place');
    }

    protected $fillable = [
        'activity_category_id',
        'title',
        'slug',
        'seo_title',
        'meta_description',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'sitemap_priority',
        'sitemap_changefreq',
        'subtitle',
        'overview',
        'itinerary',
        'includes',
        'excludes',
        'faq',
        'transportation',
        'accommodation',
        'departure',
        'altitude',
        'best_season',
        'tour_type',
        'group_size',
        'min_age',
        'max_age',
        'price_adult',
        'price_child',
        'duration_days',
        'old_price_adult',
        'old_price_child',
        'discount',
        'discount_percentage',
        'is_popular',
        'map_embed_code'
    ];

    // Relationship to Images
    public function images()
    {
        return $this->hasMany(\App\Models\ActivityImage::class);
    }


    // Relationship to Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(ActivityCategory::class, 'activity_category_id');
    }

    /**
     * Get all of the itinerary days for the Activity.
     * Defines the polymorphic relationship.
     * <<< --- ADD THIS METHOD --- >>>
     */
    public function itineraryDays()
    {
        return $this->morphMany(\App\Models\ItineraryDay::class, 'itineraryable')->orderBy('day_number');
    }



    // Slug generation logic
    protected static function booted()
    {
        static::saving(function ($activity) {
            if (empty($activity->slug) || $activity->isDirty('title')) {
                $activity->slug = Str::slug($activity->title);
                // Optional: Handle potential slug collisions
                $originalSlug = $activity->slug;
                $count = 1;
                while (static::where('slug', $activity->slug)->where('id', '!=', $activity->id)->exists()) {
                    $activity->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }
    public function firstImage()
    {
        return $this->hasOne(ActivityImage::class)->orderBy('id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFirstImageUrlAttribute(): string
    {
        if ($this->firstImage?->image_url) {
            return $this->firstImage->image_url;
        }

        if (class_exists(MediaUrl::class)) {
            return MediaUrl::placeholder();
        }

        return self::resolveMediaUrlFallback(null);
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
