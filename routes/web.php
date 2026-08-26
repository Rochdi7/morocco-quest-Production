<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityInquiryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LeadClickController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SearchBarController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourInquiryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\DmcController;
use App\Http\Controllers\TeamBuildingController;
use App\Http\Controllers\EventsProductionController;
use App\Http\Controllers\DestinationManagementController;
use App\Http\Controllers\SustainableEventsController;
use App\Http\Controllers\EventSolutions360Controller;
use App\Http\Controllers\CongressOrganizationController;
use App\Http\Controllers\MeetingsConventionsController;

// Full-page guest cache (see CacheGuestPage) — shared-hosting TTFB ~0.7s → cached hit.
Route::middleware(\App\Http\Middleware\CacheGuestPage::class)->group(function () {
    Route::get('/dmc-marrakech', [DmcController::class, 'index'])->name('dmc.marrakech');
    Route::get('/meetings-conventions-management', [MeetingsConventionsController::class, 'index'])->name('meetings-conventions.management');
    Route::get('/professional-congress-organization', [CongressOrganizationController::class, 'index'])->name('congress-organization.morocco');
    Route::get('/destination-management-company', [DestinationManagementController::class, 'index'])->name('destination-management.company');
    Route::get('/team-building-marrakech', [TeamBuildingController::class, 'index'])->name('team-building.marrakech');
    Route::get('/events-production-morocco', [EventsProductionController::class, 'index'])->name('events-production.morocco');
    Route::get('/sustainable-events-morocco', [SustainableEventsController::class, 'index'])->name('sustainable-events.morocco');
    Route::get('/360-event-solutions', [EventSolutions360Controller::class, 'index'])->name('360-solutions.morocco');
});

Route::get('/', function () {
    return app(HomepageController::class)->index();
})->name('home')->middleware(\App\Http\Middleware\CacheGuestPage::class);

// Fresh CSRF token for pages served from the guest page-cache (see
// CacheGuestPage middleware). Footer JS patches _token inputs from this.
Route::get('/csrf-refresh', function () {
    return response(csrf_token(), 200)
        ->header('Content-Type', 'text/plain')
        ->header('Cache-Control', 'no-store, private');
})->name('csrf.refresh');

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
Route::get('/destinations/{slug}', [TourController::class, 'byPlace'])->name('destinations.show');

Route::get('/tours/{slug}', [TourController::class, 'show'])->name('tours.show');

Route::prefix('tours')->name('tours.')->controller(TourController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/type/multi-day', 'showMultiDay')->name('multi_day');
    Route::get('/type/one-day', 'showOneDay')->name('one_day');
    Route::get('/type/{type}', 'showByType')->name('type');
    Route::get('/place/{slug}', fn (string $slug) => redirect()->route('destinations.show', $slug, 301))->name('byPlace');
});

Route::post('/tours/{tour}/inquiry', [TourInquiryController::class, 'store'])->name('tour.inquiry.submit');

Route::get('/experiences', [ActivityController::class, 'listCategories'])->name('experiences.index');
Route::get('/activity-categories', fn () => redirect()->route('experiences.index', [], 301))->name('activity-categories.index');

Route::prefix('activities')->name('activities.')->controller(ActivityController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/category/{category_slug}', 'showByCategory')->name('byCategory');
    Route::get('/type/{type}', 'showByType')->name('type');
    Route::get('/{slug}', 'show')->name('show');
});
Route::post('/activities/{activity}/inquiry', [ActivityInquiryController::class, 'store'])->name('activity.inquiry.submit');

Route::prefix('contact')->name('contact.')->controller(ContactController::class)->group(function () {
    Route::get('/', 'index')->name('show');
    Route::post('/', 'store')->name('submit');
});

// WhatsApp / phone click beacon (navigator.sendBeacon, no page reload).
// CSRF-exempt because the calling pages come from the guest page-cache; see
// LeadClickController for the rationale.
Route::post('/track/click', [LeadClickController::class, 'store'])
    ->middleware('throttle:30,1')
    ->name('track.click');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/about', [StaticPageController::class, 'about'])->name('about');
Route::get('/faq', [StaticPageController::class, 'faq'])->name('faq');
Route::get('/terms-and-conditions', [StaticPageController::class, 'terms'])->name('terms.conditions');
Route::get('/cookie-policy', [StaticPageController::class, 'cookie'])->name('cookie.policy');
Route::get('/privacy-policy', [StaticPageController::class, 'privacy'])->name('privacy.policy');


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
