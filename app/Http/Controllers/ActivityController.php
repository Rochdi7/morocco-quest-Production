<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityImage;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Artesaos\SEOTools\Facades\OpenGraph;
use App\Support\SeoHelper;

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

        $title       = 'Things to Do in Morocco | Activities, Day Tours & Experiences | Morocco Quest';
        $description = 'Best things to do in Morocco: camel rides, quad biking in Marrakech, desert hikes, food tours and day trips. Private & small group activities with a top-rated local agency.';
        $keywords    = [
            'things to do in morocco',
            'things to do in marrakech',
            'morocco activities',
            'morocco day tours',
            'morocco experiences',
        ];

        SeoHelper::setCollection($title, $description, url()->current(), $keywords);

        return view('activity-categories', compact('activityCategories', 'title', 'description') + ['keywords' => implode(', ', $keywords)]);
    }


    public function showByCategory($category_slug)
    {
        $category = ActivityCategory::where('slug', $category_slug)->firstOrFail();

        $activities = $category->activities()
            ->with('images')
            ->latest()
            ->paginate(9);

        $title       = "{$category->name} in Morocco | Private Tours & Day Trips | Morocco Quest";
        $description = "Book {$category->name} in Morocco with a top-rated local agency. Private tours, small group experiences and morocco day trips — book direct.";
        $keywords    = [
            strtolower($category->name),
            strtolower($category->name) . ' morocco',
            'morocco activities',
            'morocco day tours',
        ];

        $categoryImage = $category->image_path ? asset('storage/' . $category->image_path) : null;

        SeoHelper::setCollection($title, $description, url()->current(), $keywords, $categoryImage);

        return view('activities-by-category', compact('category', 'activities', 'title', 'description') + ['keywords' => implode(', ', $keywords)]);
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

        // When a category filter is active, point canonical to the clean category page
        // and suppress indexing of the query-string URL to avoid duplicate content.
        if ($categorySlug && $category) {
            $canonical = route('activities.byCategory', $category->slug);
            SeoHelper::noindex();
        } else {
            $canonical = url()->current();
        }

        $title = $category
            ? "{$category->name} in Morocco | Tours & Day Trips | Morocco Quest"
            : 'Morocco Day Tours & Activities | Browse All Experiences | Morocco Quest';

        $description = $category
            ? "Discover {$category->name} in Morocco with a top-rated local agency. Private tours, small group experiences and morocco day trips — book direct."
            : 'Browse all morocco day tours and activities: camel rides, quad biking, desert hikes, food tours, day trips from Marrakech. Book private or small group with a local agency.';

        $keywords = $category
            ? [strtolower($category->name), strtolower($category->name) . ' morocco', 'morocco activities', 'morocco day tours']
            : ['morocco day tours', 'morocco activities', 'things to do in marrakech', 'morocco day trips'];

        $categoryImage = ($category && $category->image_path) ? asset('storage/' . $category->image_path) : null;

        SeoHelper::setCollection($title, $description, $canonical, $keywords, $categoryImage);

        return view('activity-categories', compact('activities', 'category', 'title', 'description') + ['keywords' => implode(', ', $keywords)]);
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

        $description = $activity->meta_description
            ?: Str::limit(html_entity_decode(strip_tags($activity->overview ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 155);
        $image       = SeoHelper::ogImage($activity->first_image_url);
        $url         = url()->current();

        $title = $activity->seo_title
            ?: $activity->title . ' | Morocco Day Tours & Activities | Morocco Quest';

        $keywordArray = array_filter([
            strtolower($activity->title),
            optional($activity->category)->name ? strtolower(optional($activity->category)->name) : null,
            'morocco activities',
            'morocco day tours',
            'morocco quest',
        ]);
        $keywords = implode(', ', array_unique($keywordArray));

        // Basic meta — richer TouristAttraction schema is in activity-detail.blade.php via @push('jsonld')
        SeoHelper::setDetail($title, $description, $url, $keywordArray, $image, 'TouristAttraction');

        OpenGraph::setType('product');
        OpenGraph::addProperty('twitter:card', 'summary_large_image')
            ->addProperty('twitter:title', $title)
            ->addProperty('twitter:description', $description)
            ->addProperty('twitter:image', $image);

        return view('activity-detail', compact('activity', 'relatedActivities', 'title', 'description', 'keywords'));
    }


    public function showByType($slugType)
    {
        $slugType = urldecode($slugType);

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
            'multi-day-tours'    => 'Multi-Day Tours',
            'one-day-tours'      => 'One-Day Tours',
        ];

        $slugifiedType  = Str::slug($slugType);
        $normalizedType = $map[$slugifiedType] ?? $slugType;

        $tours = collect();

        $activities = Activity::where('tour_type', 'LIKE', "%{$normalizedType}%")
            ->with(['images', 'category'])
            ->paginate(12);

        $descriptionMap = [
            'garden-tours'       => 'Book morocco garden tours: the Majorelle Garden, Menara Gardens and Marrakech\'s historic riad gardens with a local guide.',
            'art-tours'          => 'Book morocco art tours: contemporary galleries, artisan workshops and the museums of Marrakech with a local guide.',
            'cultural-tours'     => 'Book morocco cultural tours: medina walks, souks, historic palaces and local traditions with a knowledgeable guide.',
            'classical-tours'    => 'Book classical morocco tours covering the imperial cities of Marrakech, Fes and Meknes with a local guide.',
            'adventure-tours'    => 'Book morocco adventure tours: Atlas Mountain hikes, quad biking and Sahara desert 4x4 routes with a local guide.',
            'day-trips'          => 'Book morocco day trips from Marrakech: the Atlas Mountains, Essaouira, Ouzoud Falls and the Agafay Desert.',
            'local-experiences'  => 'Book local morocco experiences: cooking classes, artisan visits and authentic encounters with Marrakech families.',
            'outdoor-activities' => 'Book morocco outdoor activities: hiking, camel trekking, quad biking and desert camping with a local guide.',
            'city-tours'         => 'Book morocco city tours of Marrakech, Fes and Casablanca — medinas, landmarks and local neighborhoods with a guide.',
            'multi-day-tours'    => 'Book morocco multi-day tours combining Marrakech, the Atlas Mountains and the Sahara desert with private transport.',
            'one-day-tours'      => 'Book morocco one-day tours and day trips from Marrakech with private transport and an English-speaking guide.',
        ];

        $title       = "Morocco {$normalizedType} | Private & Guided Tour Packages | Morocco Quest";
        $description = $descriptionMap[$slugifiedType]
            ?? "Book morocco {$normalizedType} with a top-rated local agency. Private tours, small group and luxury options available.";
        $keywords    = [
            'morocco ' . strtolower($normalizedType),
            strtolower($normalizedType),
            'morocco activities',
            'morocco day tours',
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
