<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Artesaos\SEOTools\Facades\OpenGraph;
use App\Support\SeoHelper;

class TripController extends Controller
{
    public function index(): View
    {
        $query = Trip::query();
        $query->with('images');
        $query->latest();
        $trips = $query->paginate(9);

        $title       = 'Morocco Trip Packages | Multi-Day Tours 3, 5 & 7 Days | Morocco Quest';
        $description = 'Browse morocco trip packages: 3-day sahara desert trip, 5-day imperial cities tour, 7-day morocco tour from Marrakech. Private & small group packages with a local agency.';
        $keywords    = [
            'morocco trip packages',
            'morocco trips',
            'morocco multi day tours',
            'morocco 7 day tour',
            'sahara desert overnight tour',
        ];

        SeoHelper::setCollection($title, $description, url()->current(), $keywords);

        OpenGraph::setType('website')->setSiteName('Morocco Quest');

        return view('trips', compact('trips', 'title', 'description', 'keywords'));
    }

    public function show(string $slug): View
    {
        $query = Trip::query();
        $query->with(['images', 'itineraryDays']);
        $query->where('slug', $slug);
        $trip = $query->firstOrFail();

        $relatedTrips = Trip::with('images')
            ->where('id', '!=', $trip->id)
            ->latest()
            ->take(3)
            ->get();

        $description = Str::limit(strip_tags($trip->overview ?? ''), 155);
        $image       = $trip->images?->first()
            ? asset('storage/' . $trip->images->first()->image_path)
            : null;
        $image       = SeoHelper::ogImage($image);
        $url         = url()->current();

        $title = $trip->title . ' | Morocco Trip Package | Morocco Quest';

        $keywordArray = array_filter(array_unique([
            strtolower($trip->title),
            'morocco trip packages',
            'morocco multi day tours',
            'private morocco tours',
            $trip->duration_days ? 'morocco ' . $trip->duration_days . ' day tour' : null,
        ]));
        $keywords = implode(', ', $keywordArray);

        SeoHelper::setDetail($title, $description, $url, $keywordArray, $image, 'TouristTrip');

        OpenGraph::setType('article')
            ->addImage($image, ['height' => 630, 'width' => 1200]);

        OpenGraph::addProperty('twitter:card', 'summary_large_image');
        OpenGraph::addProperty('twitter:title', $title);
        OpenGraph::addProperty('twitter:description', $description);
        OpenGraph::addProperty('twitter:image', $image);

        return view('trips-details', compact('trip', 'relatedTrips', 'title', 'description', 'keywords'));
    }
}
