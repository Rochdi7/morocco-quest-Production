<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Activity;
use App\Models\Blog;
use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class SitemapController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->toAtomString();

        $urls = [
            ['loc' => route('home'),                        'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '1.0'],
            ['loc' => route('tours.index'),                 'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '0.9'],
            ['loc' => route('activity-categories.index'),   'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '0.9'],
            ['loc' => route('destinations.index'),          'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('dmc.marrakech'),                     'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.9'],
            ['loc' => route('destination-management.company'),   'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.9'],
            ['loc' => route('meetings-conventions.management'),  'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.85'],
            ['loc' => route('congress-organization.morocco'),    'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.85'],
            ['loc' => route('team-building.marrakech'),          'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.85'],
            ['loc' => route('events-production.morocco'),        'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.85'],
            ['loc' => route('sustainable-events.morocco'),       'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('360-solutions.morocco'),             'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.85'],
            ['loc' => route('tours.multi_day'),             'lastmod' => $now, 'changefreq' => 'weekly',  'priority' => '0.8'],
            ['loc' => route('about'),                       'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('faq'),                         'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('blog.index'),                  'lastmod' => $now, 'changefreq' => 'weekly',  'priority' => '0.7'],
            ['loc' => route('contact.show'),                'lastmod' => $now, 'changefreq' => 'yearly',  'priority' => '0.5'],
            ['loc' => route('terms.conditions'),            'lastmod' => $now, 'changefreq' => 'yearly',  'priority' => '0.2'],
            ['loc' => route('privacy.policy'),              'lastmod' => $now, 'changefreq' => 'yearly',  'priority' => '0.2'],
        ];

        $this->addModel($urls, Tour::class,     'tours.show',      'weekly',  '0.8');
        $this->addModel($urls, Activity::class, 'activities.show', 'weekly',  '0.7');
        $this->addModel($urls, Blog::class,     'blog.show',       'weekly',  '0.6');
        $this->addPlacePages($urls, $now);

        return response()
            ->view('sitemap.index', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }

    private function addPlacePages(array &$urls, string $now): void
    {
        if (!Route::has('tours.byPlace')) return;
        if (!class_exists(Place::class)) return;

        try {
            Place::whereNotNull('slug')->chunk(100, function ($places) use (&$urls, $now) {
                foreach ($places as $place) {
                    if (empty($place->slug)) continue;
                    $urls[] = [
                        'loc'        => route('tours.byPlace', $place->slug),
                        'lastmod'    => $now,
                        'changefreq' => 'weekly',
                        'priority'   => '0.7',
                    ];
                }
            });
        } catch (\Throwable $e) {
            Log::warning('Sitemap skip Place pages: ' . $e->getMessage());
        }
    }

    private function addModel(array &$urls, string $modelClass, string $routeName, string $changefreq, string $priority): void
    {
        if (!Route::has($routeName)) return;
        if (!class_exists($modelClass)) return;

        try {
            $model = new $modelClass;
            $table = $model->getTable();

            if (!Schema::hasTable($table)) return;
            if (!Schema::hasColumn($table, 'slug')) return;

            $hasStatus = Schema::hasColumn($table, 'status');

            $query = $modelClass::query()->whereNotNull('slug');

            if ($hasStatus) {
                $query->where(function ($q) {
                    $q->whereNull('status')->orWhereIn('status', ['published', 'active']);
                });
            }

            $query->chunk(200, function ($items) use (&$urls, $routeName, $changefreq, $priority) {
                foreach ($items as $item) {
                    if (empty($item->slug)) continue;
                    $urls[] = [
                        'loc'        => route($routeName, $item->slug),
                        'lastmod'    => optional($item->updated_at)->toAtomString(),
                        'changefreq' => $changefreq,
                        'priority'   => $priority,
                    ];
                }
            });
        } catch (\Throwable $e) {
            Log::warning("Sitemap skip {$modelClass}: " . $e->getMessage());
        }
    }
}
