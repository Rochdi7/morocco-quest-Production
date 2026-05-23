<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourImage;
use App\Models\Place;
use App\Models\ItineraryDay;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Activity;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

class TourController extends Controller
{
    /**
     * Display a listing of unique places (cities) with their tour counts (Destinations Page).
     */
    public function listPlaces()
    {
        $placesData = DB::table('places')->join('place_tour', 'places.id', '=', 'place_tour.place_id')->select('places.name', 'places.slug', 'places.image_path', DB::raw('COUNT(DISTINCT place_tour.tour_id) as tours_count'))->whereNotNull('places.name')->where('places.name', '!=', '')->groupBy('places.name', 'places.slug', 'places.image_path')->orderBy('places.name', 'asc')->paginate(12);

        // ✅ SEO Setup
        $title       = 'Morocco Tour Destinations | Marrakech, Fes & Sahara Desert | Morocco Quest';
        $description = 'Explore top morocco tour destinations: Marrakech, Fes, Casablanca and Sahara desert. Book private morocco tours, small group tours morocco and luxury morocco tours.';
        $keywords    = 'morocco tours, morocco tour package, private morocco tours, morocco guided tours, morocco tour destinations, marrakech tours, sahara desert tours morocco';

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)->setDescription($description)->setType('CollectionPage');

        return view('destinations', compact('placesData', 'title', 'description', 'keywords'));
    }

    /**
     * Display a listing of the resource (tours), optionally filtered by place or search query.
     */
    public function index(Request $request)
    {
        $placeName = $request->input('place');
        $searchDate = $request->input('searchDate');
        $selectedGuests = $request->input('guests');

        $locations = Place::query()
            ->where(function ($query) {
                $query->whereHas('tours')->orWhereHas('activities');
            })
            ->whereNotNull('name')
            ->where('name', '!=', '')
            ->orderBy('name')
            ->pluck('name')
            ->unique();

        $toursQuery = Tour::query()
            ->with(['firstImage', 'places'])
            ->withCount('places');

        if ($placeName) {
            $toursQuery->whereHas('places', function ($q) use ($placeName) {
                $q->where('name', $placeName);
            });
        }

        if ($searchDate) {
            try {
                $date = Carbon::parse($searchDate);
                $monthAbbr = $date->format('M');
                $toursQuery->whereRaw('CONCAT(",", REPLACE(best_season, " ", ""), ",") LIKE ?', ['%,' . $monthAbbr . ',%']);
            } catch (\Exception $e) {
                // invalid date format, ignore
            }
        }

        if ($selectedGuests && is_numeric($selectedGuests)) {
            $guestCount = (int) $selectedGuests;
            $toursQuery->where(function ($query) use ($guestCount) {
                $query->orWhere(function ($q) use ($guestCount) {
                    $q->where('group_size', 'REGEXP', '^[0-9]+$')->where(DB::raw('CAST(group_size AS UNSIGNED)'), '>=', $guestCount);
                });
                $query->orWhere(function ($q) use ($guestCount) {
                    $q->where('group_size', 'REGEXP', '^[0-9]+\s*-\s*[0-9]+$')->where(DB::raw('CAST(SUBSTRING_INDEX(group_size, "-", -1) AS UNSIGNED)'), '>=', $guestCount);
                });
                $query->orWhere(function ($q) use ($guestCount) {
                    $q->where('group_size', 'REGEXP', '^[0-9]+\s*\+$')->where(DB::raw('CAST(SUBSTRING_INDEX(group_size, "+", 1) AS UNSIGNED)'), '<=', $guestCount);
                });
            });
        }

        $tours = $toursQuery->latest()->paginate(8);

        $popularTours = Tour::where('is_popular', true)
            ->with(['firstImage', 'places'])
            ->get();

        $nonPopularTours = Tour::where('is_popular', false)
            ->whereNotIn('id', $popularTours->pluck('id'))
            ->with(['firstImage', 'places'])
            ->get();

        $topTours = $popularTours->concat($nonPopularTours);

        // --- SEO Setup ---
        $title = $placeName
            ? "Morocco Tours in {$placeName} | Private & Guided Tour Packages | Morocco Quest"
            : 'Morocco Tours & Private Sahara Desert Trips from Marrakech | Morocco Quest';

        $desc = $placeName
            ? "Discover morocco tours in {$placeName}. Private morocco tours, small group tours morocco and luxury morocco tours with a top-rated local agency. Book online."
            : 'Browse morocco tour packages: private morocco tours, sahara desert tours from Marrakech, small group tours morocco and luxury morocco tours. Book direct with a local agency.';

        $keywords = $placeName
            ? "morocco tours, {$placeName} tours, tours in {$placeName} morocco, morocco tour package, private morocco tours, morocco guided tours"
            : 'morocco tours, private morocco tours, morocco tour package, sahara desert tours morocco, morocco desert tours from marrakech, small group tours morocco, luxury morocco tours, morocco guided tours';

        SEOMeta::setTitle($title)
            ->setDescription($desc)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($desc)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)->setDescription($desc);

        return view('tours-list', compact('tours', 'locations', 'placeName', 'searchDate', 'selectedGuests', 'topTours', 'title', 'desc', 'keywords'));
    }

    /**
     * Display the specified resource (tour details).
     */
    public function show($slug)
    {
        // 1️⃣ Try exact slug first (normal case)
        $tour = Tour::with(['images', 'itineraryDays', 'places'])
            ->where('slug', $slug)
            ->first();

        // 2️⃣ If NOT found → try to recover old slug (SEO FIX)
        if (!$tour) {
            $normalizedSlug = Str::slug($slug);

            $possibleTour = Tour::where(function ($query) use ($normalizedSlug) {
                $query->where('slug', 'LIKE', "%{$normalizedSlug}%")->orWhereRaw('? LIKE CONCAT("%", slug, "%")', [$normalizedSlug]);
            })->first();

            if ($possibleTour) {
                // 🔥 301 redirect to the correct new slug
                return redirect()->route('tours.show', $possibleTour->slug)->setStatusCode(301);
            }

            // Still not found → real 404
            abort(404);
        }

        // 3️⃣ Related tours
        $relatedTours = Tour::with(['firstImage'])
            ->withCount('places')
            ->where('id', '!=', $tour->id)
            ->whereHas('places', function ($query) use ($tour) {
                $query->whereIn('name', $tour->places->pluck('name'));
            })
            ->take(4)
            ->get();

        // --- SEO Setup ---
        $description = Str::limit(strip_tags($tour->overview), 160);
        $image = $tour->first_image_url;
        $url = url()->current();

        $title = $tour->title . ' | Morocco Tours from Marrakech | Morocco Quest';

        $keywordArray = array_filter([
            'morocco tours',
            'private morocco tours',
            'morocco tour package',
            'morocco guided tours',
            'small group tours morocco',
            'luxury morocco tours',
            'sahara desert tours morocco',
            'morocco desert tours from marrakech',
            'morocco multi day tours',
            'morocco day tours',
            'morocco private tour',
            strtolower($tour->title),
            $tour->duration,
            ...$tour->places->pluck('name')->toArray(),
        ]);
        $keywords = implode(', ', array_unique($keywordArray));

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical($url)
            ->addKeyword($keywordArray);

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl($url)
            ->setType('article')
            ->addImage($image, ['height' => 630, 'width' => 1200]);

        JsonLd::setType('TouristTrip')->setTitle($title)->setDescription($description)->setUrl($url)->addImage($image);

        return view('tour-detail', compact('tour', 'relatedTours', 'title', 'description', 'keywords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation stays the same...
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:tours,title',
            // ... other fields
            'price_adult' => 'required|numeric|min:0',
            // ... other fields
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'places' => 'nullable|array', // Array of city/place names
            'places.*' => 'nullable|string|max:255', // Each place name
        ]);

        $tourData = collect($validatedData)
            ->except(['images', 'places'])
            ->toArray();
        $tourData['slug'] = Str::slug($validatedData['title']);

        // Handle potential slug collisions
        $originalSlug = $tourData['slug'];
        $count = 1;
        while (Tour::where('slug', $tourData['slug'])->exists()) {
            $tourData['slug'] = $originalSlug . '-' . $count++;
        }

        $tour = Tour::create($tourData);

        // Handle Image Uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('images/tours', $filename, 'public');
                $tour->images()->create(['image' => 'storage/' . $path]); // Assumes TourImage model setup
            }
        }

        // Handle Places (Cities)
        if (!empty($validatedData['places'])) {
            foreach ($validatedData['places'] as $placeName) {
                $trimmedName = trim($placeName);
                if (!empty($trimmedName)) {
                    // Creates a new Place record associated with this Tour
                    $tour->places()->create(['name' => $trimmedName]); // Assumes Place model setup
                }
            }
        }

        // Add itineraryDays logic here if needed

        return redirect()->route('tours.show', $tour->slug)->with('success', 'Tour created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $tour = Tour::with(['images', 'places', 'itineraryDays']) // Eager load places for the form
            ->where('slug', $slug)
            ->firstOrFail();

        return view('admin.tours.edit', compact('tour')); // Ensure this view exists
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $tour = Tour::where('slug', $slug)->firstOrFail();

        // Validation stays the same...
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('tours')->ignore($tour->id)],
            // ... other fields
            'price_adult' => 'required|numeric|min:0',
            // ... other fields
            'places' => 'nullable|array',
            'places.*' => 'nullable|string|max:255',
            // Add image update validation if needed
        ]);

        $tourData = collect($validatedData)
            ->except(['places'])
            ->toArray();

        // Update slug only if title changed
        if ($request->input('title') !== $tour->title) {
            $tourData['slug'] = Str::slug($validatedData['title']);
            $originalSlug = $tourData['slug'];
            $count = 1;
            while (Tour::where('slug', $tourData['slug'])->where('id', '!=', $tour->id)->exists()) {
                $tourData['slug'] = $originalSlug . '-' . $count++;
            }
        } else {
            unset($tourData['slug']); // Don't update slug if title hasn't changed
        }

        $tour->update($tourData);

        // Sync Places (Efficiently updates the relationship)
        $newPlaces = [];
        if (!empty($validatedData['places'])) {
            foreach ($validatedData['places'] as $placeName) {
                $trimmedName = trim($placeName);
                if (!empty($trimmedName)) {
                    // Prepare data for createMany - doesn't save yet
                    $newPlaces[] = ['name' => $trimmedName];
                }
            }
        }
        $tour->places()->delete(); // Delete old places associated with this tour
        if (!empty($newPlaces)) {
            $tour->places()->createMany($newPlaces); // Create all new places at once
        }

        // Add logic for image updates (upload new, delete selected) if needed

        return redirect()
            ->route('tours.show', $tour->fresh()->slug) // Use fresh() in case slug changed
            ->with('success', 'Tour updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $tour = Tour::where('slug', $slug)->firstOrFail();

        // Optional: Add manual file deletion logic if needed
        // Storage::disk('public')->delete(...);

        $tour->delete(); // This should cascade delete related places, images due to onDelete('cascade')

        return redirect()
            ->route('tours.index') // Redirect to the main tours list
            ->with('success', 'Tour deleted successfully!');
    }
    public function byPlace($slug)
    {
        $place = Place::where('slug', $slug)->firstOrFail();

        $tours = $place
            ->tours()
            ->with(['firstImage', 'places'])
            ->latest()
            ->paginate(8);

        // 🔥 SEO Meta for location-based tours
        $title = "Tours in {$place->name} Morocco | Day Trips & Private Tours | Morocco Quest";

        $description = "Best morocco tours in {$place->name}. Private morocco tours, day trips from {$place->name}, small group tours morocco and luxury morocco tour packages.";

        $keywords = "morocco tours, tours in {$place->name} morocco, {$place->name} tours, day trips from {$place->name} morocco, private morocco tours, morocco tour package";

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)->setDescription($description)->setType('TouristTrip');

        return view('tours-list', [
            'tours' => $tours,
            'placeName' => $place->name,
            'query' => null,
            'locations' => Place::pluck('name')->unique(),
            'searchDate' => null,
            'selectedGuests' => null,
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }

    public function showMultiDay()
    {
        $tours = Tour::with(['firstImage', 'places'])->paginate(12);

        $activities = new LengthAwarePaginator([], 0, 12);

        // 🔥 SEO Meta for multi-day
        $title = 'Morocco Multi Day Tours | 3, 5 & 7 Day Morocco Tour Packages | Morocco Quest';

        $description = 'Book morocco multi day tours: 3-day sahara desert tour, 7 day morocco tour, multi-day tours in morocco. Private morocco tours and small group tours morocco from Marrakech.';

        $keywords = 'morocco multi day tours, morocco multi day tour, multi-day tours in morocco, morocco 7 day tour, 7 day trip to morocco, morocco tour package, private morocco tours, small group tours morocco';

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)->setDescription($description)->setType('TouristTrip');

        return view('type-filter', [
            'tours' => $tours,
            'activities' => $activities,
            'type' => 'Multi-Day Tours',
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }

    public function showOneDay()
    {
        $types = ['City Tours', 'Day Trips', 'Local Experiences', 'Outdoor Activities'];

        $tours = Tour::whereIn('tour_type', $types)
            ->with(['firstImage', 'places'])
            ->paginate(12);

        $activities = Activity::whereIn('tour_type', $types)
            ->with(['images', 'category'])
            ->paginate(12);

        // 🔥 SEO Meta for one-day experiences
        $title = 'Morocco Day Tours & Day Trips from Marrakech | Morocco Quest';

        $description = 'Best morocco day tours and day trips from Marrakech: Atlas Mountains, Ourika Valley, Essaouira, Agafay desert. Private morocco tours and small group day trips.';

        $keywords = 'morocco day tours, morocco day trips, day trips from marrakech morocco, morocco day trips from marrakech, atlas mountains morocco day trip from marrakech, essaouira morocco day trip from marrakech, day tours in marrakech morocco';

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)->setDescription($description)->setType('TouristTrip');

        return view('type-filter', [
            'tours' => $tours,
            'activities' => $activities,
            'type' => 'One-Day Tours',
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ]);
    }

    public function showByType($type)
    {
        $type = urldecode($type);

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
        ];

        $slugifiedType = Str::slug($type);
        $normalizedType = $map[$slugifiedType] ?? $type;

        // Handle redirects
        if ($slugifiedType === 'multi-day-tours') {
            return redirect()->route('tours.multi_day');
        }
        if ($slugifiedType === 'one-day-tours') {
            return redirect()->route('tours.one_day');
        }

        $tours = Tour::where('tour_type', 'LIKE', "%{$normalizedType}%")
            ->with(['firstImage', 'places'])
            ->paginate(12);

        $activities = Activity::where('tour_type', 'LIKE', "%{$normalizedType}%")
            ->with(['images', 'category'])
            ->paginate(12);

        // 🔥 SEO for specific tour types
        $title = "Morocco {$normalizedType} | Private & Guided Tour Packages | Morocco Quest";

        $description = "Book morocco {$normalizedType} with a top-rated local agency. Private morocco tours, small group tours morocco, luxury morocco tours and morocco tour packages.";

        $keywords = "morocco tours, morocco {$normalizedType}, " . strtolower($normalizedType) . ", morocco tour package, private morocco tours, morocco guided tours, small group tours morocco";

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)->setDescription($description)->setType('TouristTrip');

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
