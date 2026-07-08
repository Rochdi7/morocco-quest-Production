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

use Artesaos\SEOTools\Facades\OpenGraph;
use App\Support\SeoHelper;

class TourController extends Controller
{
    /**
     * Display a listing of unique places (cities) with their tour counts (Destinations Page).
     */
    public function listPlaces()
    {
        $placesData = DB::table('places')->join('place_tour', 'places.id', '=', 'place_tour.place_id')->select('places.name', 'places.slug', 'places.image_path', DB::raw('COUNT(DISTINCT place_tour.tour_id) as tours_count'))->whereNotNull('places.name')->where('places.name', '!=', '')->groupBy('places.name', 'places.slug', 'places.image_path')->orderBy('places.name', 'asc')->paginate(12);

        $title       = 'Morocco Tour Destinations | Marrakech, Fes & Sahara Desert | Morocco Quest';
        $description = 'Explore top morocco tour destinations: Marrakech, Fes, Casablanca and Sahara desert. Book private morocco tours, small group tours morocco and luxury morocco tours.';
        $keywords    = [
            'morocco tour destinations',
            'morocco tours',
            'marrakech tours',
            'sahara desert tours morocco',
            'private morocco tours',
        ];

        SeoHelper::setCollection($title, $description, url()->current(), $keywords);

        return view('destinations', compact('placesData', 'title', 'description', 'keywords'));
    }

    /**
     * Display a listing of the resource (tours), optionally filtered by place or search query.
     */
    public function index(Request $request)
    {
        $placeName      = $request->input('place');
        $searchDate     = $request->input('searchDate');
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
                $date      = Carbon::parse($searchDate);
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

        // Date/guest filter URLs are thin-content variants — noindex,follow.
        // ?place= has a canonical clean URL at /tours/place/{slug} — noindex too so the clean URL ranks.
        $isFiltered = $searchDate || $selectedGuests;
        $hasPlace   = (bool) $placeName;

        if ($isFiltered) {
            $canonical = route('tours.index');
            SeoHelper::noindex();
        } elseif ($hasPlace) {
            $place     = Place::where('name', $placeName)->whereNotNull('slug')->first();
            $canonical = $place ? route('tours.byPlace', $place->slug) : route('tours.index');
            SeoHelper::noindex();
        } else {
            $canonical = url()->current();
        }

        $title = $placeName
            ? "Tours in {$placeName} Morocco | Private Day Trips & Multi-Day Tours | Morocco Quest"
            : 'Morocco Tour Packages | Browse All Private & Group Tours | Morocco Quest';

        $desc = $placeName
            ? "Explore all tours in {$placeName}, Morocco. Compare private day trips, multi-day packages and small group tours. Book direct with a local Marrakech-based agency."
            : 'Browse all morocco tour packages: private day trips, multi-day sahara desert tours, small group tours morocco and luxury morocco tours. Book direct with a top-rated local agency.';

        $keywords = $placeName
            ? ["tours in {$placeName} morocco", "{$placeName} day trips", 'morocco tour package', 'private morocco tours']
            : ['morocco tour packages', 'morocco tours', 'private morocco tours', 'sahara desert tours morocco'];

        SeoHelper::setCollection($title, $desc, $canonical, $keywords);

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
                return redirect()->route('tours.show', $possibleTour->slug)->setStatusCode(301);
            }

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

        $description = Str::limit(strip_tags($tour->overview), 155);
        $image       = SeoHelper::ogImage($tour->first_image_url);
        $url         = url()->current();

        $title = $tour->title . ' | Morocco Tours from Marrakech | Morocco Quest';

        $keywordArray = array_filter(array_unique([
            strtolower($tour->title),
            'morocco tours',
            'private morocco tours',
            'morocco tour package',
            ...$tour->places->pluck('name')->map(fn($n) => strtolower($n))->toArray(),
        ]));
        $keywords = implode(', ', $keywordArray);

        SeoHelper::setDetail($title, $description, $url, $keywordArray, $image, 'TouristTrip');

        OpenGraph::setType('article')
            ->addImage($image, ['height' => 630, 'width' => 1200]);

        return view('tour-detail', compact('tour', 'relatedTours', 'title', 'description', 'keywords'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255|unique:tours,title',
            'price_adult' => 'required|numeric|min:0',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'places'      => 'nullable|array',
            'places.*'    => 'nullable|string|max:255',
        ]);

        $tourData         = collect($validatedData)->except(['images', 'places'])->toArray();
        $tourData['slug'] = Str::slug($validatedData['title']);

        $originalSlug = $tourData['slug'];
        $count        = 1;
        while (Tour::where('slug', $tourData['slug'])->exists()) {
            $tourData['slug'] = $originalSlug . '-' . $count++;
        }

        $tour = Tour::create($tourData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path     = $file->storeAs('images/tours', $filename, 'public');
                $tour->images()->create(['image' => 'storage/' . $path]);
            }
        }

        if (!empty($validatedData['places'])) {
            foreach ($validatedData['places'] as $placeName) {
                $trimmedName = trim($placeName);
                if (!empty($trimmedName)) {
                    $tour->places()->create(['name' => $trimmedName]);
                }
            }
        }

        return redirect()->route('tours.show', $tour->slug)->with('success', 'Tour created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $tour = Tour::with(['images', 'places', 'itineraryDays'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('admin.tours.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $tour = Tour::where('slug', $slug)->firstOrFail();

        $validatedData = $request->validate([
            'title'       => ['required', 'string', 'max:255', Rule::unique('tours')->ignore($tour->id)],
            'price_adult' => 'required|numeric|min:0',
            'places'      => 'nullable|array',
            'places.*'    => 'nullable|string|max:255',
        ]);

        $tourData = collect($validatedData)->except(['places'])->toArray();

        if ($request->input('title') !== $tour->title) {
            $tourData['slug'] = Str::slug($validatedData['title']);
            $originalSlug     = $tourData['slug'];
            $count            = 1;
            while (Tour::where('slug', $tourData['slug'])->where('id', '!=', $tour->id)->exists()) {
                $tourData['slug'] = $originalSlug . '-' . $count++;
            }
        } else {
            unset($tourData['slug']);
        }

        $tour->update($tourData);

        $newPlaces = [];
        if (!empty($validatedData['places'])) {
            foreach ($validatedData['places'] as $placeName) {
                $trimmedName = trim($placeName);
                if (!empty($trimmedName)) {
                    $newPlaces[] = ['name' => $trimmedName];
                }
            }
        }
        $tour->places()->delete();
        if (!empty($newPlaces)) {
            $tour->places()->createMany($newPlaces);
        }

        return redirect()
            ->route('tours.show', $tour->fresh()->slug)
            ->with('success', 'Tour updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $tour = Tour::where('slug', $slug)->firstOrFail();
        $tour->delete();

        return redirect()
            ->route('tours.index')
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

        $title       = "Tours in {$place->name} Morocco | Day Trips & Private Tours | Morocco Quest";
        $description = "Best morocco tours in {$place->name}. Private morocco tours, day trips from {$place->name}, small group tours morocco and luxury morocco tour packages.";
        $keywords    = [
            "tours in {$place->name} morocco",
            "{$place->name} tours",
            "day trips from {$place->name}",
            'private morocco tours',
        ];

        $placeImage = $place->image_path ? asset('storage/' . $place->image_path) : null;

        SeoHelper::setCollection($title, $description, url()->current(), $keywords, $placeImage);

        return view('tours-list', [
            'tours'          => $tours,
            'placeName'      => $place->name,
            'query'          => null,
            'locations'      => Place::pluck('name')->unique(),
            'searchDate'     => null,
            'selectedGuests' => null,
            'title'          => $title,
            'description'    => $description,
            'keywords'       => implode(', ', $keywords),
        ]);
    }

    public function showMultiDay()
    {
        $tours      = Tour::with(['firstImage', 'places'])->paginate(12);
        $activities = new LengthAwarePaginator([], 0, 12);

        $title       = 'Morocco Multi Day Tours | 3, 5 & 7 Day Morocco Tour Packages | Morocco Quest';
        $description = 'Book morocco multi day tours: 3-day sahara desert tour, 7 day morocco tour, multi-day tours in morocco. Private morocco tours and small group tours morocco from Marrakech.';
        $keywords    = [
            'morocco multi day tours',
            'morocco 7 day tour',
            'multi-day tours in morocco',
            'morocco tour package',
            'private morocco tours',
        ];

        SeoHelper::setCollection($title, $description, url()->current(), $keywords);

        return view('type-filter', [
            'tours'       => $tours,
            'activities'  => $activities,
            'type'        => 'Multi-Day Tours',
            'title'       => $title,
            'description' => $description,
            'keywords'    => implode(', ', $keywords),
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

        $title       = 'Morocco Day Tours & Day Trips from Marrakech | Morocco Quest';
        $description = 'Best morocco day tours and day trips from Marrakech: Atlas Mountains, Ourika Valley, Essaouira, Agafay desert. Private morocco tours and small group day trips.';
        $keywords    = [
            'morocco day tours',
            'morocco day trips',
            'day trips from marrakech',
            'atlas mountains day trip morocco',
            'essaouira day trip morocco',
        ];

        SeoHelper::setCollection($title, $description, url()->current(), $keywords);

        return view('type-filter', [
            'tours'       => $tours,
            'activities'  => $activities,
            'type'        => 'One-Day Tours',
            'title'       => $title,
            'description' => $description,
            'keywords'    => implode(', ', $keywords),
        ]);
    }

    public function showByType($type)
    {
        $type = urldecode($type);

        $map = [
            'garden-tours'       => 'Garden Tour',
            'art-tours'          => 'Art Tour',
            'cultural-tours'     => 'Cultural Tour',
            'classical-tours'    => 'Classical Tours',
            'adventure-tours'    => 'Adventure Tours',
            'day-trips'          => 'Day Trips',
            'local-experiences'  => 'Local Experiences',
            'outdoor-activities' => 'Outdoor Activities',
            'city-tours'         => 'City Tours',
        ];

        $slugifiedType  = Str::slug($type);
        $normalizedType = $map[$slugifiedType] ?? $type;

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

        $title       = "Morocco {$normalizedType} | Private & Guided Tour Packages | Morocco Quest";
        $description = "Book morocco {$normalizedType} with a top-rated local agency. Private morocco tours, small group tours morocco, luxury morocco tours and morocco tour packages.";
        $keywords    = [
            'morocco ' . strtolower($normalizedType),
            strtolower($normalizedType),
            'morocco tours',
            'private morocco tours',
        ];

        SeoHelper::setCollection($title, $description, url()->current(), $keywords);

        return view('type-filter', [
            'tours'       => $tours,
            'activities'  => $activities,
            'type'        => $normalizedType,
            'title'       => $title,
            'description' => $description,
            'keywords'    => implode(', ', $keywords),
        ]);
    }
}
