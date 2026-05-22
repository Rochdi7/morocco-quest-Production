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
            ? 'Search Results for "' . $query . '" | Morocco Tours | Morocco Quest'
            : 'Search Morocco Tours, Day Trips & Activities | Morocco Quest';

        $description = $query
            ? 'Search results for "' . $query . '" across morocco tours, sahara desert tours, morocco day trips and travel articles.'
            : 'Search morocco tours, private morocco tours, sahara desert tours from Marrakech, morocco day trips and morocco tour packages. Book direct with a local agency.';

        $keywordArray = array_filter([
            'morocco tours',
            'morocco tour package',
            'private morocco tours',
            'sahara desert tours morocco',
            'morocco day tours',
            'morocco day trips',
            $query ? strtolower($query) : null,
        ]);
        $keywords = implode(', ', array_unique($keywordArray));


        SEOMeta::setTitle($title)
            ->setDescription(Str::limit($description, 160))
            ->setCanonical($url)
            ->addKeyword($keywordArray);

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
            'guests',
            'title',
            'description',
            'keywords'
        ));
    }
}
