<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Tour;

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityInquiryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SearchBarController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourInquiryController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\DmcController;

Route::get('/dmc-marrakech', [DmcController::class, 'index'])->name('dmc.marrakech');

Route::get('/', function () {
    return app(HomepageController::class)->index();
})->name('home');

Route::get('/search-bar', [SearchBarController::class, 'index'])->name('search.bar');
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/search', 'search')->name('search');
    Route::get('/{slug}', 'show')->name('show');
});
Route::post('/comments/{id}', [CommentController::class, 'store'])->name('comments.store');
Route::post('/blog/comments/reply/{id}', [BlogController::class, 'replyToComment'])->name('blog.comments.reply');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/tag/{tag:slug}', [TagController::class, 'show'])->name('tag.show');

Route::get('/destinations', [TourController::class, 'listPlaces'])->name('destinations.index');

Route::get('/tours/{slug}', function ($slug) {
    $tour = Tour::where('slug', $slug)->first();
    if ($tour) {
        return app(TourController::class)->show($slug);
    }

    $normalized = Str::slug($slug);

    $possible = Tour::where(function ($q) use ($normalized) {
        $q->where('slug', 'LIKE', "%{$normalized}%")
          ->orWhereRaw('? LIKE CONCAT("%", slug, "%")', [$normalized]);
    })->first();

    if ($possible) {
        return redirect()->route('tours.show', $possible->slug, 301);
    }

    abort(404);
})->name('tours.show');

Route::prefix('tours')->name('tours.')->controller(TourController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/type/multi-day', 'showMultiDay')->name('multi_day');
    Route::get('/type/one-day', 'showOneDay')->name('one_day');
    Route::get('/type/{type}', 'showByType')->name('type');
    Route::get('/place/{slug}', 'byPlace')->name('byPlace');
});

Route::post('/tours/{tour}/inquiry', [TourInquiryController::class, 'store'])->name('tour.inquiry.submit');

Route::get('/activity-categories', [ActivityController::class, 'listCategories'])->name('activity-categories.index');

Route::prefix('activities')->name('activities.')->controller(ActivityController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/category/{category_slug}', 'showByCategory')->name('byCategory');
    Route::get('/type/{type}', 'showByType')->name('type');
    Route::get('/{slug}', 'show')->name('show');
});
Route::post('/activities/{activity}/inquiry', [ActivityInquiryController::class, 'store'])->name('activity.inquiry.submit');

Route::prefix('trips')->name('trips.')->controller(TripController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{slug}', 'show')->name('show');
});
Route::post('/trips/{trip}/inquire', [InquiryController::class, 'storeTripInquiry'])->name('trip.inquiry');

Route::prefix('contact')->name('contact.')->controller(ContactController::class)->group(function () {
    Route::get('/', 'index')->name('show');
    Route::post('/', 'store')->name('submit');
});

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/about', [StaticPageController::class, 'about'])->name('about');
Route::get('/faq', [StaticPageController::class, 'faq'])->name('faq');
Route::get('/terms-and-conditions', [StaticPageController::class, 'terms'])->name('terms.conditions');
Route::get('/cookie-policy', [StaticPageController::class, 'cookie'])->name('cookie.policy');
Route::get('/privacy-policy', [StaticPageController::class, 'privacy'])->name('privacy.policy');

Route::get('/test-mail', function () {
    Mail::raw('Test email from Morocco Quest', function ($message) {
        $message->to('morocco.quests@gmail.com')->subject('Test Email');
    });
    return 'Mail sent';
});


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::prefix('tours')->name('tours.')->controller(TourController::class)->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{tour:slug}/edit', 'edit')->name('edit');
        Route::put('/{tour:slug}', 'update')->name('update');
        Route::delete('/{tour:slug}', 'destroy')->name('destroy');
    });
});

// SEO: sitemap.xml
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::fallback(fn () => abort(404));
