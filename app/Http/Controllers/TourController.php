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

class TourController extends Controller
{
    /**
     * Display a listing of unique places (cities) with their tour counts (Destinations Page).
     */
    public function listPlaces()
    {
        $placesData = DB::table('places')
            ->join('place_tour', 'places.id', '=', 'place_tour.place_id')
            ->select(
                'places.name',
                'places.image_path',
                // VVV CHANGE THE ALIAS HERE VVV
                DB::raw('COUNT(DISTINCT place_tour.tour_id) as tours_count') // Use 'tours_count' (plural)
            )
            ->whereNotNull('places.name')
            ->where('places.name', '!=', '')
            ->groupBy('places.name', 'places.image_path') // Grouping is correct
            ->orderBy('places.name', 'asc')
            ->paginate(12); // Adjust pagination number if needed

        // Pass the data to the view
        return view('destinations', compact('placesData'));
    }

    /**
     * Display a listing of the resource (tours), optionally filtered by place or search query.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $placeName = $request->input('place'); // Gets the city name from the URL (?place=CityName)

        $toursQuery = Tour::query()
                          ->with(['firstImage']) // Eager load the first image for performance
                          ->withCount('places'); // Useful if you want to show # of places per tour

        // Filter by Place Name if provided
        if ($placeName) {
            $toursQuery->whereHas('places', function ($q) use ($placeName) {
                $q->where('name', $placeName); // Filter tours that have a place matching the name
            });
        }
        // Apply search query if provided (and no place filter)
        elseif ($query) {
            $toursQuery->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('overview', 'LIKE', "%{$query}%")
                  ->orWhere('departure', 'LIKE', "%{$query}%")
                  ->orWhere('tour_type', 'LIKE', "%{$query}%");
                  // Add other searchable fields if needed
            });
        }

        // Get paginated results
        $tours = $toursQuery->latest()->paginate(8); // Adjust pagination as needed

        // Return the view for the tours list
        return view('tours-list', compact('tours', 'placeName', 'query')); // <--- VIEW NAME CONFIRMED
    }

    /**
     * Display the specified resource (tour details).
     */
    public function show($slug) // Uses route model binding implicitly if configured
    {
         // Find tour by slug, eager load relations
         $tour = Tour::with(['images', 'itineraryDays', 'places'])
                     ->where('slug', $slug)
                     ->firstOrFail(); // Fails if not found

        // Example: Get related tours (e.g., in the same primary place or type) - Improve this logic
        $relatedTours = Tour::with(['firstImage'])
                            ->withCount('places')
                            ->where('id', '!=', $tour->id)
                            // Add better related logic if possible (e.g., same tour_type)
                            ->latest()
                            ->take(4)
                            ->get();

        return view('tour-detail', compact('tour', 'relatedTours'));
    }


    // --- STORE / EDIT / UPDATE / DESTROY methods remain largely the same ---
    // They already handle the 'places' array correctly based on your previous code.

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
            'places'   => 'nullable|array', // Array of city/place names
            'places.*' => 'nullable|string|max:255' // Each place name
        ]);

        $tourData = collect($validatedData)->except(['images', 'places'])->toArray();
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

        return redirect()->route('tours.show', $tour->slug)
                         ->with('success', 'Tour created successfully!');
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
            'title' => ['required','string','max:255', Rule::unique('tours')->ignore($tour->id)],
             // ... other fields
            'price_adult' => 'required|numeric|min:0',
            // ... other fields
            'places'   => 'nullable|array',
            'places.*' => 'nullable|string|max:255'
            // Add image update validation if needed
        ]);

        $tourData = collect($validatedData)->except(['places'])->toArray();

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

        return redirect()->route('tours.show', $tour->fresh()->slug) // Use fresh() in case slug changed
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

        return redirect()->route('tours.index') // Redirect to the main tours list
                         ->with('success', 'Tour deleted successfully!');
    }
}