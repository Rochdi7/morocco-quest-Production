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

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $place = $request->input('place');
        $guests = $request->input('guests');

        $tours = collect();
        $activities = collect();
        $blogs = collect();

        // ✅ Text search
        if ($query) {
            $tours = Tour::where('title', 'like', '%' . $query . '%')
                ->orWhere('overview', 'like', '%' . $query . '%')
                ->get();

            $activities = Activity::where('title', 'like', '%' . $query . '%')
                ->orWhere('overview', 'like', '%' . $query . '%')
                ->get();

            $blogs = Blog::where('title', 'like', '%' . $query . '%')
                ->orWhere('summary', 'like', '%' . $query . '%')
                ->orWhere('content', 'like', '%' . $query . '%')
                ->get();
        }

        // ✅ Place + guest filter
        if ($place && $guests) {
            $tours = Tour::whereHas('places', function ($q) use ($place) {
                $q->where('name', $place);
            })
                ->get()
                ->filter(function ($tour) use ($guests) {
                    if (!$tour->group_size) return false;
                    $parts = explode('-', $tour->group_size);
                    $min = isset($parts[0]) ? (int) trim($parts[0]) : null;
                    return $min !== null && $min >= $guests;
                });

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
        }

        // ✅ SEO Meta Tags
        $url = url()->current() . '?' . http_build_query($request->only(['query', 'place', 'guests']));

        $title = $query
            ? "Search results for \"$query\" | Private Morocco Tours"
            : "Private Morocco Tours & Exclusive Morocco Travel Experiences | Morocco Quest";

        $description = $query
            ? "Find private tours morocco, small group tours morocco, and activities related to \"$query\". We offer exclusive morocco travel experiences, vip morocco tours, and morocco travel services."
            : "Explore curated private morocco tours, small group tours morocco, and exclusive morocco travel experiences. Book the best private tour morocco with Morocco Quest.";

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
            // Existing keywords
            $query,
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

        return view('search.results', compact(
            'query',
            'tours',
            'activities',
            'blogs',
            'place',
            'guests'
        ));
    }
}
