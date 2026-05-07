<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityImage;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class ActivityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'activity_category_id' => 'nullable|exists:activity_categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $activityData = $request->except('images');
        $activityData['slug'] = Str::slug($request->title);

        $activity = Activity::create($activityData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/images/activities'), $filename);

                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image' => 'storage/images/activities/' . $filename,
                ]);
            }
        }

        return redirect()->route('activity-categories')->with('success', 'Activity created successfully!');
    }

    public function listCategories()
    {
        $activityCategories = ActivityCategory::query()
            ->withCount('activities')
            ->orderBy('name', 'asc')
            ->paginate(9);

        // ✅ SEO Setup
        $title = "Morocco Activities & Day Tours | Marrakech Desert Tours - Morocco Quest";

        $description = "Morocco activities and day tours: marrakech desert tours, sahara desert tour from marrakech, and private tours in morocco.";


        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('CollectionPage');

        return view('activity-categories', compact('activityCategories'));
    }


    public function showByCategory($category_slug)
    {
        $category = ActivityCategory::where('slug', $category_slug)->firstOrFail();

        $activities = $category->activities()
            ->with('images')
            ->latest()
            ->paginate(9);

        $title = "{$category->name} Activities | Marrakech Desert Tours - Morocco Quest";
        $description = "Explore our curated {$category->name}. Marrakech desert tours, sahara desert tour from marrakech, and private tours in morocco with Morocco Quest.";

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('TouristTrip');

        return view('activities-by-category', compact('category', 'activities'));
    }



    public function index(Request $request)
    {
        $categorySlug = $request->query('category');

        $activitiesQuery = Activity::query()
            ->with(['images', 'category'])
            ->latest();

        if ($categorySlug) {
            $activitiesQuery->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        }

        $activities = $activitiesQuery->paginate(12);
        $category = $categorySlug ? ActivityCategory::where('slug', $categorySlug)->first() : null;

        $title = $category
            ? "{$category->name} | Marrakech Desert Tours - Morocco Quest"
            : "Morocco Private Tours & Marrakech Desert Tours | Morocco Quest";

        $description = $category
            ? "Explore {$category->name} in Morocco. Marrakech desert tours, sahara desert tour from marrakech, and morocco private tours with expert guides."
            : "Discover the best morocco private tour company. Marrakech desert tours, sahara desert tour from marrakech, and luxury desert tours marrakech.";

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('TouristTrip');

        return view('activity-categories', compact('activities', 'category'));
    }



    public function show($slug)
    {
        $activity = Activity::with(['images', 'category', 'itineraryDays'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedActivities = Activity::with('images')
            ->where('id', '!=', $activity->id)
            ->when($activity->activity_category_id, function ($query) use ($activity) {
                $query->where('activity_category_id', $activity->activity_category_id);
            })
            ->latest()
            ->take(3)
            ->get();

        $description = Str::limit(strip_tags($activity->overview ?? ''), 160);
        $image = $activity->images->first()->image ?? asset('images/default-activity.jpg');
        $url = url()->current();

        // Extensive keyword integration for specific activity pages
        $keywords = array_filter([
            'morocco private tours',
            'private morocco tours',
            'marrakech desert tours',
            'desert tours marrakech',
            'sahara desert tour from marrakech',
            'sahara desert tours from marrakech',
            'luxury desert tours marrakech',
            'private tours in morocco',
            'private tours of morocco',
            'private tour morocco',
            'desert tour from marrakech',
            'agafay desert tour from marrakech',
            'merzouga desert tour from marrakech',
            'private sahara desert tour from marrakech',
            'private tour guide morocco',
            strtolower($activity->title),
            optional($activity->category)->name,
        ]);

        // SEO Meta
        SEOMeta::setTitle($activity->title . ' | Morocco Quest')
            ->setDescription($description)
            ->setCanonical($url)
            ->addKeyword($keywords);

        OpenGraph::setTitle($activity->title)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image)
            ->addProperty('twitter:card', 'summary_large_image')
            ->addProperty('twitter:title', $activity->title)
            ->addProperty('twitter:description', $description)
            ->addProperty('twitter:image', $image);

        JsonLd::setTitle($activity->title)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image)
            ->setType('TouristTrip');

        return view('activity-detail', compact('activity', 'relatedActivities'));
    }



    public function showByType($slugType)
    {
        $slugType = urldecode($slugType);

        $map = [
            'garden-tours' => 'Garden Tour',
            'art-tours' => 'Art Tour',
            'cultural-tours' => 'Cultural Tour',
            'classical-tours' => 'Classical Tours',
            'adventure-tours' => 'Adventure Tours',
            'day-trips' => 'Day Trips',
            'local-experiences' => 'Local Experiences',
            'outdoor-activities' => 'Outdoor Activities',
            'city-tours' => 'City Tours',
            'multi-day-tours' => 'Multi-Day Tours',
            'one-day-tours' => 'One-Day Tours',
        ];

        $slugifiedType = Str::slug($slugType);
        $normalizedType = $map[$slugifiedType] ?? $slugType;

        $tours = collect(); // Not used here but might be later

        $activities = Activity::where('tour_type', 'LIKE', "%{$normalizedType}%")
            ->with(['images', 'category'])
            ->paginate(12);

        $title = "Morocco {$normalizedType} & Marrakech Desert Tours | Morocco Quest";

        $description = "Experience {$normalizedType} with Morocco Quest. Morocco private tours, marrakech desert tours, and sahara desert tour from marrakech.";


        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('TouristTrip');

        return view('type-filter', [
            'tours' => $tours,
            'activities' => $activities,
            'type' => $normalizedType
        ]);
    }
}
