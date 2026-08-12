<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tour;
use App\Models\Activity;
use App\Models\Place;
use App\Models\ActivityCategory;
use Illuminate\View\View;
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
        $title = 'Morocco Tours & Private Sahara Desert Trips from Marrakech | Morocco Quest';
        $description = 'Morocco Quest — top-rated local agency for private morocco tours, sahara desert trips from Marrakech, small group tours & luxury morocco tour packages. Book direct, best price guaranteed.';
        $keywords = 'morocco tours, private morocco tours, morocco tour package, sahara desert tours morocco, morocco desert tours from marrakech, small group tours morocco, luxury morocco tours, morocco guided tours';
        $url = url('/');
        $image = asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp');

        SEOMeta::setTitle($title, false)
            ->setDescription($description)
            ->setCanonical($url)
            ->addKeyword([
                'morocco tours',
                'private morocco tours',
                'morocco tour package',
                'sahara desert tours morocco',
                'morocco desert tours from marrakech',
                'small group tours morocco',
                'luxury morocco tours',
                'morocco guided tours',
                'morocco tour packages',
                'best morocco tours',
                'morocco private tour',
                'morocco day tours',
                'morocco multi day tours',
                'things to do in marrakech',
                'morocco family tours',
                'morocco adventure tours',
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
        | Latest Blog Posts (Cached)
        |--------------------------------------------------------------------------
        */
        $latestPosts = Cache::remember('home_latest_posts', 3600, function () {
            return Blog::latest()
                ->take(3)
                ->get()
                ->map(function ($post) {
                    return (object) [
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'written_by' => $post->written_by ?? 'Admin',
                        'featured_image_url' => $post->featured_image_url,
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
        $topTours = Cache::remember('home_top_tours', 3600, function () {
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
        $featuredActivities = Cache::remember('home_featured_activities', 3600, function () {
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
        $locations = Cache::remember('home_locations', 3600, function () {
            return collect()
                ->merge(Place::whereNotNull('name')->where('name', '!=', '')->pluck('name'))
                ->merge(ActivityCategory::whereNotNull('name')->where('name', '!=', '')->pluck('name'))
                ->unique()
                ->sort()
                ->values();
        });

        $seasons = Cache::remember('home_seasons', 3600, function () {
            return collect()
                ->merge(Tour::whereNotNull('best_season')->pluck('best_season'))
                ->merge(Activity::whereNotNull('best_season')->pluck('best_season'))
                ->filter()
                ->unique()
                ->sort()
                ->values();
        });

        $groupSizes = Cache::remember('home_group_sizes', 3600, function () {
            return collect()
                ->merge(Tour::whereNotNull('group_size')->pluck('group_size'))
                ->merge(Activity::whereNotNull('group_size')->pluck('group_size'))
                ->filter()
                ->unique()
                ->sort()
                ->values();
        });

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
            'title',
            'description',
            'keywords'
        ));
    }
}
