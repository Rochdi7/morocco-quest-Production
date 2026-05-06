<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PlaceController; // Import PlaceController if used elsewhere
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TripController;

use App\Models\Blog;
use App\Models\Tour;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Place;
use App\Models\Category; // Keep if CategoryController uses it directly
use App\Models\Tag;       // Keep if TagController uses it directly

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Public Facing Routes ---

Route::get('/', function () {
    $latestPosts = Blog::latest()->take(3)->get();
    $topTours = Tour::with(['firstImage', 'places'])
                   ->latest()
                   ->take(4)
                   ->get();
    $featuredActivities = Activity::with('images')
                                  ->latest()
                                  ->take(6)
                                  ->get();
    return view('home', compact('latestPosts', 'topTours', 'featuredActivities'));
})->name('home');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// --- Blog ---
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/tag/{tag:slug}', [TagController::class, 'show'])->name('tag.show');

// --- Tours & Destinations ---
Route::get('/destinations', [TourController::class, 'listPlaces'])->name('destinations.index');
Route::get('/tours', [TourController::class, 'index'])->name('tours.index'); // Handles listing and filtering by place (?place=...)
Route::get('/tours/search', [TourController::class, 'search'])->name('tours.search'); // Make sure this method exists if needed
Route::get('/tours/{slug}', [TourController::class, 'show'])->name('tours.show');
Route::post('/tours/{tour:slug}/inquiry', [InquiryController::class, 'storeTourInquiry'])->name('tour.inquiry');
Route::get('/destinations', [TourController::class, 'listPlaces'])
     ->name('destinations.list');// --- Activities ---
Route::get('/activity-categories', [ActivityController::class, 'listCategories'])->name('activity-categories.index');
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index'); // Handles listing specific activities, possibly filtered by category (?category=...)
Route::get('/activity/{slug}', [ActivityController::class, 'show'])->name('activities.show');
Route::get('/activities/category/{category_slug}', [ActivityController::class, 'showByCategory'])
    ->name('activities.byCategory');
// --trips

// Route for the trip listing page
// Add ->name('trips') to the end
Route::get('/trips', [App\Http\Controllers\TripController::class, 'index'])->name('trips');
// Route for individual trip details (using slug) - Placeholder
Route::get('/trips/{slug}', [TripController::class, 'show'])->name('trips.show');
// --- Admin Routes (Example) ---
Route::prefix(prefix: 'admin')->name('admin.')->middleware(['auth'/*, 'isAdmin'*/])->group(function () {
    // Example CRUD routes for Tours within Admin panel
    Route::get('/tours/create', [TourController::class, 'create'])->name('tours.create');
    Route::post('/tours', [TourController::class, 'store'])->name('tours.store');
    Route::get('/tours/{slug}/edit', [TourController::class, 'edit'])->name('tours.edit');
    Route::put('/tours/{slug}', [TourController::class, 'update'])->name('tours.update');
    Route::delete('/tours/{slug}', [TourController::class, 'destroy'])->name('tours.destroy');

    // Add similar routes for Blog, Activities, Categories, Tags etc. if managed via admin
    // Route::resource('blog', AdminBlogController::class); // Example using a dedicated Admin controller
});


// --- Contact Route (ACTION: Create ContactController if needed) ---
// Example: Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [InquiryController::class, 'storeContactInquiry'])->name('contact.submit'); // Route for form submission
// --- Authentication Routes (if using Laravel Breeze/Jetstream/UI) ---
// require __DIR__.'/auth.php'; // Common location for auth routes
Route::post('/trips/{slug}/inquire', [InquiryController::class, 'storeTripInquiry'])->name('trip.inquiry');
Route::post('/inquire/{type}/{slug}', [InquiryController::class, 'storeUnifiedInquiry'])->name('inquiry.submit');

// --- SEO: sitemap.xml and robots.txt ---
Route::get('/sitemap.xml', function () {
    $tours = Tour::select('slug', 'updated_at')->orderBy('updated_at', 'desc')->get();
    $activities = Activity::select('slug', 'updated_at')->orderBy('updated_at', 'desc')->get();
    $activityCategories = ActivityCategory::select('slug', 'updated_at')->get();
    $blogs = Blog::select('slug', 'updated_at')->orderBy('updated_at', 'desc')->get();
    $categories = Category::select('slug')->get();
    $tags = Tag::select('slug')->get();
    $places = Place::select('slug')->get();

    return response()
        ->view('sitemap', compact('tours', 'activities', 'activityCategories', 'blogs', 'categories', 'tags', 'places'))
        ->header('Content-Type', 'application/xml; charset=utf-8');
})->name('sitemap');

Route::get('/robots.txt', function () {
    $content = "User-agent: *\n"
        . "Allow: /\n"
        . "Disallow: /admin/\n"
        . "Disallow: /login\n"
        . "Disallow: /register\n"
        . "Disallow: /password/\n"
        . "Disallow: /storage/framework/\n"
        . "Disallow: /vendor/\n"
        . "\n"
        . "Sitemap: " . url('/sitemap.xml') . "\n";

    return response($content, 200)->header('Content-Type', 'text/plain; charset=utf-8');
})->name('robots');
