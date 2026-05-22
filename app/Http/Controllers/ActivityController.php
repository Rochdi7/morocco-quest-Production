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
        $title = "Morocco Activities & Day Tours | Camel, Quad, Hiking & Food Tours | Morocco Quest";

        $description = "Top morocco activities: camel tours, quad biking marrakech, morocco hiking tours, food tours and morocco day tours. Book private morocco tours and small group experiences.";

        $keywords = 'morocco day tours, morocco day trips, morocco camel tours, morocco hiking tours, morocco food tour, quad biking marrakech, morocco trekking tours, morocco cycling tours';

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('CollectionPage');

        return view('activity-categories', compact('activityCategories', 'title', 'description', 'keywords'));
    }


    public function showByCategory($category_slug)
    {
        $category = ActivityCategory::where('slug', $category_slug)->firstOrFail();

        $activities = $category->activities()
            ->with('images')
            ->latest()
            ->paginate(9);

        $title = "{$category->name} in Morocco | Private Tours & Day Trips | Morocco Quest";
        $description = "Book {$category->name} in Morocco with a top-rated local agency. Private morocco tours, small group tours morocco and morocco day tours.";
        $keywords = strtolower($category->name) . ", morocco {$category->name}, morocco tours, morocco day tours, morocco tour package, private morocco tours, morocco guided tours";

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('TouristTrip');

        return view('activities-by-category', compact('category', 'activities', 'title', 'description', 'keywords'));
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
            ? "{$category->name} in Morocco | Tours & Day Trips | Morocco Quest"
            : "Morocco Activities & Day Tours | Camel, Quad, Hiking, Food | Morocco Quest";

        $description = $category
            ? "Discover {$category->name} in Morocco with a top-rated local agency. Private morocco tours, small group tours morocco and morocco day tours."
            : "Top morocco activities: camel tours, quad biking marrakech, hiking, food tours and morocco day tours. Book private morocco tours with a top-rated local agency.";

        $keywords = $category
            ? strtolower($category->name) . ", morocco tours, morocco day tours, morocco tour package, private morocco tours"
            : 'morocco day tours, morocco day trips, morocco camel tours, morocco hiking tours, morocco food tour, quad biking marrakech, morocco trekking tours';

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setType('TouristTrip');

        return view('activity-categories', compact('activities', 'category', 'title', 'description', 'keywords'));
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

        $title = $activity->title . ' | Morocco Day Tours & Activities | Morocco Quest';

        // Extensive keyword integration for specific activity pages
        $keywordArray = array_filter([
            'morocco tours',
            'morocco day tours',
            'morocco day trips',
            'morocco tour package',
            'private morocco tours',
            'morocco guided tours',
            'small group tours morocco',
            'morocco camel tours',
            'morocco hiking tours',
            'morocco food tour',
            'quad biking marrakech',
            strtolower($activity->title),
            optional($activity->category)->name,
        ]);
        $keywords = implode(', ', array_unique($keywordArray));

        // SEO Meta
        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical($url)
            ->addKeyword($keywordArray);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image)
            ->addProperty('twitter:card', 'summary_large_image')
            ->addProperty('twitter:title', $title)
            ->addProperty('twitter:description', $description)
            ->addProperty('twitter:image', $image);

        JsonLd::setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->addImage($image)
            ->setType('TouristTrip');

        return view('activity-detail', compact('activity', 'relatedActivities', 'title', 'description', 'keywords'));
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

        $title = "Morocco {$normalizedType} | Private & Guided Tour Packages | Morocco Quest";

        $description = "Book morocco {$normalizedType} with a top-rated local agency. Private morocco tours, small group tours morocco and luxury morocco tours.";

        $keywords = "morocco tours, morocco {$normalizedType}, " . strtolower($normalizedType) . ", morocco tour package, private morocco tours, morocco guided tours, small group tours morocco";

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
            'type' => $normalizedType,
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }
}
