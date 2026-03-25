<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Activity;
use App\Models\Blog;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class SearchBarController extends Controller
{
    public function index(Request $request)
    {
        $place = $request->input('place');
        $guests = (int) $request->input('guests');

        $tours = collect();
        $activities = collect();

        // ✅ SEO Setup
        $url = url()->current() . '?' . http_build_query($request->only(['place', 'guests']));

        $description = $place
            ? "Find private tours morocco and small group tours morocco in $place for $guests+ guests. We offer exclusive morocco travel experiences, vip morocco tours, and authentic local experiences."
            : "Search for the best private tour morocco for your next trip. Discover small group tours morocco, exclusive morocco travel experiences, and vip morocco tours tailored to you.";

        $title = $place
            ? "Private Morocco Tours in $place | Morocco Quest"
            : "Private Morocco Tours & Exclusive Morocco Travel Experiences Search | Morocco Quest";

        $keywords = array_filter([
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
            // Existing dynamic inputs
            $place,
            $guests ? "private tours morocco for $guests guests" : null,
        ]);


        SEOMeta::setTitle($title)
            ->setDescription(Str::limit($description, 160))
            ->setCanonical($url)
            ->addKeyword($keywords);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->addProperty('type', 'website');

        OpenGraph::addProperty('twitter:card', 'summary_large_image');
        OpenGraph::addProperty('twitter:title', $title);
        OpenGraph::addProperty('twitter:description', $description);

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('SearchResultsPage')
            ->setUrl($url);

        // ✅ Skip filtering if not enough data
        if (!$place || !$guests) {
            return view('search-bar', compact('tours', 'activities'))
                ->with('filters', $request->all());
        }

        // ✅ Tour filter by place & guests
        $tours = Tour::whereHas('places', function ($q) use ($place) {
            $q->where('name', $place);
        })->get()->filter(function ($tour) use ($guests) {
            if (!$tour->group_size) return false;

            $parts = explode('-', $tour->group_size);
            $min = isset($parts[0]) ? (int) trim($parts[0]) : null;

            return $min !== null && $min >= $guests;
        });

        // ✅ Activity filter by place/category & guests
        $activities = Activity::where(function ($query) use ($place) {
            $query->whereHas('places', function ($q) use ($place) {
                $q->where('name', $place);
            })->orWhereHas('category', function ($q) use ($place) {
                $q->where('name', $place);
            });
        })->get()->filter(function ($activity) use ($guests) {
            if (!$activity->group_size) return false;

            $parts = explode('-', $activity->group_size);
            $min = isset($parts[0]) ? (int) trim($parts[0]) : null;

            return $min !== null && $min >= $guests;
        });

        return view('search-bar', compact('tours', 'activities'))
            ->with('filters', $request->all());
    }
}
