<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // ✅ Meta (passed to layout via bridge)
        $title       = 'Morocco Tours & Private Sahara Desert Trips from Marrakech | Morocco Quest';
        $description = 'Morocco Quest offers private morocco tours, sahara desert tours from Marrakech, luxury & small group trips. Book your guided morocco tour package with a top-rated local agency.';
        $keywords    = 'morocco tours, private morocco tours, morocco tour package, sahara desert tours morocco, morocco desert tours from marrakech, small group tours morocco, luxury morocco tours, morocco guided tours';

        // ✅ Cache latest blog posts (1h to keep response time low)
        $latestPosts = Cache::remember('latest_posts', 3600, function () {
            return Blog::latest()->take(3)->get();
        });

        // ✅ Cache top tours (1h)
        $topTours = Cache::remember('top_tours', 3600, function () {
            return Tour::with(['firstImage'])
                ->latest()
                ->take(4)
                ->get();
        });

        // ✅ TravelAgency JSON-LD (cached for response time)
        $schemaJson = Cache::remember('home_schema_json', 86400, function () use ($description) {
            $schema = [
                '@context'      => 'https://schema.org',
                '@type'         => 'TravelAgency',
                '@id'           => url('/') . '#travelagency',
                'name'          => 'Morocco Quest',
                'alternateName' => 'Morocco Quest Tours & Travel',
                'url'           => url('/'),
                'description'   => 'Morocco Quest is a licensed Moroccan travel agency offering private morocco tours, sahara desert tours from Marrakech, luxury desert camps, small group tours, and tailor-made morocco tour packages.',
                'image'         => asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp'),
                'logo'          => [
                    '@type'  => 'ImageObject',
                    'url'    => asset('assets/img/logo-bg-wide.webp'),
                    'width'  => 600,
                    'height' => 200,
                ],
                'priceRange'    => '$$-$$$',
                'telephone'     => '+212-654-069-718',
                'address'       => [
                    '@type'           => 'PostalAddress',
                    'addressLocality' => 'Marrakech',
                    'addressRegion'   => 'Marrakech-Safi',
                    'addressCountry'  => 'MA',
                ],
                'geo'           => [
                    '@type'    => 'GeoCoordinates',
                    'latitude' => '31.6295',
                    'longitude'=> '-7.9811',
                ],
                'areaServed' => [
                    ['@type' => 'Country', 'name' => 'Morocco'],
                    ['@type' => 'City',    'name' => 'Marrakech'],
                    ['@type' => 'City',    'name' => 'Fes'],
                    ['@type' => 'City',    'name' => 'Casablanca'],
                    ['@type' => 'Place',   'name' => 'Sahara Desert'],
                    ['@type' => 'Place',   'name' => 'Merzouga'],
                ],
                'knowsAbout' => [
                    'morocco tours',
                    'private morocco tours',
                    'sahara desert tours morocco',
                    'morocco desert tours from marrakech',
                    'morocco tour package',
                    'small group tours morocco',
                    'luxury morocco tours',
                    'morocco guided tours',
                ],
                'sameAs' => [
                    'https://www.facebook.com/profile.php?id=61578772746041',
                    'https://www.instagram.com/moroccoquestdmc/',
                    'https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html',
                ],
            ];

            return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        });

        return view('home', compact(
            'latestPosts',
            'topTours',
            'schemaJson',
            'title',
            'description',
            'keywords'
        ));
    }
}
