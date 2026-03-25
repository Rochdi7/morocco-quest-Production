<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // ✅ Cache latest blog posts
        $latestPosts = Cache::remember('latest_posts', 60, function () {
            return Blog::latest()->take(3)->get();
        });

        // ✅ Cache top tours
        $topTours = Cache::remember('top_tours', 60, function () {
            return Tour::with(['firstImage'])
                ->latest()
                ->take(4)
                ->get();
        });

        // ✅ SEO JSON-LD (ANTI Blade / HTML Minify issues)
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "TravelAgency",
            "@id" => url('/') . "#travelagency",
            "name" => "Morocco Quest",
            "alternateName" => "MoroccoQuest",
            "url" => url('/'),
            "description" => "Morocco Quest specializes in morocco luxury tours, private guided tours morocco, and luxury sahara desert tour morocco.",
            "image" => asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp'),
            "logo" => [
                "@type" => "ImageObject",
                "url" => asset('assets/img/logo-bg-wide.webp'),
                "width" => 600,
                "height" => 200,
            ],
            "address" => [
                "@type" => "PostalAddress",
                "addressLocality" => "Marrakech",
                "addressRegion" => "Marrakech-Safi",
                "addressCountry" => "MA",
            ],
            "sameAs" => [
                "https://www.facebook.com/codesommetagency/",
                "https://www.instagram.com/moroccoquestdmc/",
                "https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html",
            ],
        ];

        $schemaJson = json_encode(
            $schema,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );

        // ✅ Return homepage view
        return view('home', compact(
            'latestPosts',
            'topTours',
            'schemaJson'
        ));
    }
}
