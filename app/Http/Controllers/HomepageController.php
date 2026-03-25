<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tour;
use App\Models\Activity;
use App\Models\Place;
use App\Models\ActivityCategory;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class HomepageController extends Controller
{
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | SEO – Core Meta (OPTIMIZED)
        |--------------------------------------------------------------------------
        */
        $title = 'Private Morocco Tours & Exclusive Morocco Travel Experiences | Morocco Quest';
        $description = 'Book private tours morocco and small group tours morocco with Morocco Quest. We are a trusted private tour operator offering unforgettable exclusive morocco travel experiences.';
        $url = url('/');
        $image = asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp');

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical($url)
            ->addKeyword([
                'morocco private tours',
                'private morocco tours',
                'private morocco tour',
                'private tours morocco',
                'private tour morocco',
                'small group tours morocco',
                'morocco small group tours',
                'exclusive morocco travel experiences',
                'vip morocco tours',
                'morocco luxury travel',
                'luxury travel morocco',
                'morocco travel insurance',
                'morocco travel agent',
                'what is the best time to travel to morocco',
                'morocco travel visa requirements',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Open Graph / Twitter
        |--------------------------------------------------------------------------
        */
        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->setType('website')
            ->setSiteName('Morocco Quest')
            ->addImage($image, [
                'width'  => 1200,
                'height' => 630,
            ]);

        OpenGraph::addProperty('twitter:card', 'summary_large_image');
        OpenGraph::addProperty('twitter:title', $title);
        OpenGraph::addProperty('twitter:description', $description);
        OpenGraph::addProperty('twitter:image', $image);

        /*
        |--------------------------------------------------------------------------
        | JSON-LD – TravelAgency (SAFE)
        |--------------------------------------------------------------------------
        | ✅ On passe un ARRAY au Blade (pas une string JSON)
        | ✅ Le Blade générera le JSON via @json()
        */
        $schemaJson = [
            '@context' => 'https://schema.org',
            '@type' => 'TravelAgency',
            'name' => 'Morocco Quest',
            'alternateName' => 'MoroccoQuest',
            'url' => $url,
            'description' => $description,
            'image' => $image,
            'logo' => asset('assets/img/logo-bg-wide.webp'), // si tu as un vrai logo séparé
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Marrakech',
                'addressRegion' => 'Marrakech-Safi',
                'addressCountry' => 'MA',
            ],
            'sameAs' => [
                'https://www.facebook.com/codesommetagency/',
                'https://www.instagram.com/moroccoquestdmc/',
                'https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html',
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+212 654 069 718',
                'contactType' => 'Customer Support',
                'areaServed' => ['MA', 'US', 'EU'],
                'availableLanguage' => ['English', 'French', 'Spanish'],
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Latest Blog Posts (Cached)
        |--------------------------------------------------------------------------
        */
        $latestPosts = Cache::remember('home_latest_posts', 60, function () {
            return Blog::latest()
                ->take(3)
                ->get()
                ->map(function ($post) {
                    $imagePath = Str::startsWith($post->featured_image, 'public/storage/')
                        ? $post->featured_image
                        : 'public/storage/' . ltrim($post->featured_image, '/');

                    return (object) [
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'written_by' => $post->written_by ?? 'Admin',
                        'featured_image_url' => asset($imagePath),
                        'created_day' => Carbon::parse($post->created_at)->format('d'),
                        'created_month' => Carbon::parse($post->created_at)->format('M'),
                        'comments_count' => method_exists($post, 'comments')
                            ? $post->comments->count()
                            : 0,
                    ];
                });
        });

        /*
        |--------------------------------------------------------------------------
        | Top Tours
        |--------------------------------------------------------------------------
        */
        $topTours = Cache::remember('home_top_tours', 60, function () {
            return Tour::with(['firstImage', 'places'])
                ->latest()
                ->take(4)
                ->get();
        });

        /*
        |--------------------------------------------------------------------------
        | Featured Activities
        |--------------------------------------------------------------------------
        */
        $featuredActivities = Cache::remember('home_featured_activities', 60, function () {
            return Activity::with('images')
                ->latest()
                ->take(6)
                ->get();
        });

        /*
        |--------------------------------------------------------------------------
        | Filters (Locations / Seasons / Group Sizes)
        |--------------------------------------------------------------------------
        */
        $locations = collect()
            ->merge(Place::whereNotNull('name')->where('name', '!=', '')->pluck('name'))
            ->merge(ActivityCategory::whereNotNull('name')->where('name', '!=', '')->pluck('name'))
            ->unique()
            ->sort()
            ->values();

        $seasons = collect()
            ->merge(Tour::whereNotNull('best_season')->pluck('best_season'))
            ->merge(Activity::whereNotNull('best_season')->pluck('best_season'))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $groupSizes = collect()
            ->merge(Tour::whereNotNull('group_size')->pluck('group_size'))
            ->merge(Activity::whereNotNull('group_size')->pluck('group_size'))
            ->filter()
            ->unique()
            ->sort()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */
        return view('home', compact(
            'latestPosts',
            'topTours',
            'featuredActivities',
            'locations',
            'seasons',
            'groupSizes',
            'schemaJson'
        ));
    }
}
