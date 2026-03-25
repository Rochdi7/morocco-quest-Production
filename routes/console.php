<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Carbon;

// Models
use App\Models\Tour;
use App\Models\Activity;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Inspire
|--------------------------------------------------------------------------
*/
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
});

/*
|--------------------------------------------------------------------------
| Generate Sitemap (FINAL – SCHEMA SAFE)
|--------------------------------------------------------------------------
*/
Artisan::command('generate:sitemap', function () {

    $sitemap = Sitemap::create();

    /*
    |--------------------------------------------------------------------------
    | Static Pages
    |--------------------------------------------------------------------------
    */
    $staticRoutes = [
        'home',
        'search',
        'contact.show',
        'about',
        'faq',
        'terms.conditions',
        'cookie.policy',
        'privacy.policy',
        'tours.index',
        'activities.index',
        'blog.index',
    ];

    foreach ($staticRoutes as $routeName) {
        if (Route::has($routeName)) {
            $sitemap->add(
                Url::create(route($routeName))
                    ->setLastModificationDate(Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Tours
    |--------------------------------------------------------------------------
    */
    Tour::query()
        ->whereNotNull('slug')
        ->each(function (Tour $tour) use ($sitemap) {
            $sitemap->add(
                Url::create(route('tours.show', $tour->slug))
                    ->setLastModificationDate($tour->updated_at ?? Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.7)
            );
        });

    /*
    |--------------------------------------------------------------------------
    | Activities
    |--------------------------------------------------------------------------
    */
    Activity::query()
        ->whereNotNull('slug')
        ->each(function (Activity $activity) use ($sitemap) {
            $sitemap->add(
                Url::create(route('activities.show', $activity->slug))
                    ->setLastModificationDate($activity->updated_at ?? Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.7)
            );
        });

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */
    Category::query()
        ->whereNotNull('slug')
        ->each(function (Category $category) use ($sitemap) {
            $sitemap->add(
                Url::create(route('category.show', $category->slug))
                    ->setLastModificationDate($category->updated_at ?? Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.5)
            );
        });

    /*
    |--------------------------------------------------------------------------
    | Write sitemap.xml
    |--------------------------------------------------------------------------
    */
    $sitemap->writeToFile(public_path('sitemap.xml'));

    $this->info('✅ Sitemap generated successfully (FINAL & CLEAN).');

})->purpose('Generate sitemap.xml for Morocco Quest');
