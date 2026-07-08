<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Activity;
use App\Models\Blog;
use App\Support\SeoHelper;
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
            ? 'Search results for "' . $place . '" on morocco tours, private morocco tours, sahara desert tours and morocco day trips.'
            : 'Search morocco tours, sahara desert tours from Marrakech, morocco day trips and morocco tour packages. Book direct with a local agency.';

        $title = $place
            ? 'Tours in ' . $place . ' Morocco | Search Results | Morocco Quest'
            : 'Search Morocco Tours, Day Trips & Activities | Morocco Quest';

        $keywordArray = array_filter([
            'morocco tours',
            'morocco tour package',
            'private morocco tours',
            'sahara desert tours morocco',
            'morocco day tours',
            'morocco day trips',
            $place ? strtolower($place) . ' tours' : null,
        ]);
        $keywords = implode(', ', array_unique($keywordArray));


        SeoHelper::noindex();

        SEOMeta::setTitle($title)
            ->setDescription(Str::limit($description, 160))
            ->setCanonical(route('home'))
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

        // ✅ Skip filtering if not enough data
        if (!$place || !$guests) {
            return view('search-bar', compact('tours', 'activities', 'title', 'description', 'keywords'))
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

        return view('search-bar', compact('tours', 'activities', 'title', 'description', 'keywords'))
            ->with('filters', $request->all());
    }
}
