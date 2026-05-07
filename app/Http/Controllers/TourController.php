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
        $title = 'Morocco Private Tours & Marrakech Desert Tours | Morocco Quest';
        $description = 'Plan your morocco private tours with Morocco Quest. We offer marrakech desert tours, sahara desert tour from marrakech, and luxury desert tours marrakech tailored for you.';

        SEOMeta::setTitle($title)
            ->setDescription($description)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($description)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)->setDescription($description)->setType('CollectionPage');

        return view('destinations', compact('placesData', 'title', 'description'));
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
        $title = $placeName ? "Marrakech Desert Tours in $placeName & Morocco Private Tours | Morocco Quest" : 'Marrakech Desert Tours | Desert Tours Marrakech & Sahara Desert Tour from Marrakech | Morocco Quest';

        $desc = $placeName ? "Private morocco tours in $placeName. Marrakech desert tours, sahara desert tour from marrakech, and luxury desert tours marrakech." : 'Marrakech desert tours, desert tours marrakech, and sahara desert tour from marrakech. Luxury desert tours marrakech and private morocco tours.';

        SEOMeta::setTitle($title)
            ->setDescription($desc)
            ->setCanonical(url()->current());

        OpenGraph::setTitle($title)
            ->setDescription($desc)
            ->setUrl(url()->current());

        JsonLd::setTitle($title)->setDescription($desc);

        return view('tours-list', compact('tours', 'locations', 'placeName', 'searchDate', 'selectedGuests', 'topTours', 'title', 'desc'));
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
        $image = optional($tour->images->first())->image ?? asset('images/default-cover.jpg');
        $url = url()->current();

        $keywords = array_filter([
            'morocco private tours',
            'private morocco tours',
            'marrakech desert tours',
            'desert tours marrakech',
            'desert tour marrakech',
            'marrakech desert tour',
            'sahara desert tour from marrakech',
            'sahara desert tours from marrakech',
            'luxury desert tours marrakech',
            'luxury sahara desert tour from marrakech',
            'private tours in morocco',
            'private tours of morocco',
            'private tour morocco',
            'morocco desert tours from marrakech',
            'marrakech sahara desert tour',
            'desert tour from marrakech',
            strtolower($tour->title),
            $tour->duration,
            ...$tour->places->pluck('name')->toArray(),
        ]);

        SEOMeta::setTitle($tour->title . ' | Morocco Quest')
            ->setDescription($description)
            ->setCanonical($url)
            ->addKeyword($keywords);

        OpenGraph::setTitle($tour->title)
            ->setDescription($description)
            ->setUrl($url)
            ->setType('article')
            ->addImage($image, ['height' => 630, 'width' => 1200]);

        JsonLd::setType('TouristTrip')->setTitle($tour->title)->setDescription($description)->setUrl($url)->addImage($image);

        return view('tour-detail', compact('tour', 'relatedTours'));
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
        $title = "Marrakech Desert Tours in {$place->name} | Morocco Private Tours | Morocco Quest";

        $description = "Experience morocco private tours in {$place->name}. Marrakech desert tours, sahara desert tour from marrakech, and luxury desert tours marrakech.";

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
        ]);
    }

    public function showMultiDay()
    {
        $tours = Tour::with(['firstImage', 'places'])->paginate(12);

        $activities = new LengthAwarePaginator([], 0, 12);

        // 🔥 SEO Meta for multi-day
        $title = 'Marrakech Desert Tour 3 Days & Marrakech Desert Tours 4 Days | Morocco Quest';

        $description = 'Book marrakech desert tour 3 days and marrakech desert tours 4 days. Sahara desert tour from marrakech, morocco private tours, and luxury desert tours marrakech.';

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
        $title = 'Desert Tour from Marrakech & Agafay Desert Tour from Marrakech | Morocco Quest';

        $description = 'Join our desert tour from marrakech and agafay desert tour from marrakech. Morocco private tours, private tours in morocco, and marrakech desert tours for short stays.';

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
        $title = "Morocco Private Tours - {$normalizedType} | Marrakech Desert Tours | Morocco Quest";

        $description = "Explore {$normalizedType} with the best morocco private tour company. Marrakech desert tours, sahara desert tour from marrakech, and luxury desert tours marrakech tailored for you.";

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
        ]);
    }
}
