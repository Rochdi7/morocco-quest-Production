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
            ['loc' => route('experiences.index'),           'lastmod' => $now, 'changefreq' => 'weekly',  'priority' => '0.8'],
            ['loc' => route('activities.index'),            'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '0.8'],
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
            ['loc' => route('cookie.policy'),                'lastmod' => $now, 'changefreq' => 'yearly',  'priority' => '0.2'],
        ];

        $this->addModel($urls, Tour::class,     'tours.show',      'weekly',  '0.8');
        $this->addModel($urls, Activity::class, 'activities.show', 'weekly',  '0.7');
        $this->addModel($urls, Blog::class,     'blog.show',       'weekly',  '0.6');
        $this->addPlacePages($urls, $now);
        $this->addStaticTypePages($urls, $now);

        $urls = collect($urls)
            ->map(function (array $url) {
                $url['loc'] = $this->canonicalUrl($url['loc']);
                return $url;
            })
            ->unique('loc')
            ->values()
            ->all();

        return response()
            ->view('sitemap.index', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Tour/activity type + category pages use hardcoded slugs in the nav
     * (see header.blade.php / header2.blade.php), not DB-driven routes, so
     * they can't go through addModel(). Kept in sync with those partials.
     */
    private function addStaticTypePages(array &$urls, string $now): void
    {
        if (Route::has('tours.type')) {
            foreach (['Garden Tours', 'Art Tours', 'Classical Tours'] as $type) {
                    $urls[] = ['loc' => $this->canonicalUrl(route('tours.type', $type)), 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.6'];
            }
        }

        if (Route::has('activities.byCategory')) {
            foreach (['city-tours', 'day-trips', 'food-culinary-tours', 'local-experiences', 'outdoor-activities', 'wellness-experiences'] as $slug) {
                    $urls[] = ['loc' => $this->canonicalUrl(route('activities.byCategory', $slug)), 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.6'];
            }
        }
    }

    private function addPlacePages(array &$urls, string $now): void
    {
        if (!Route::has('destinations.show')) return;
        if (!class_exists(Place::class)) return;

        try {
            Place::whereNotNull('slug')->chunk(100, function ($places) use (&$urls, $now) {
                foreach ($places as $place) {
                    if (empty($place->slug)) continue;
                    $urls[] = [
                        'loc'        => $this->canonicalUrl(route('destinations.show', $place->slug)),
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
            $hasIsActive = Schema::hasColumn($table, 'is_active');
            $hasCanonicalUrl = Schema::hasColumn($table, 'canonical_url');
            $hasSitemapPriority = Schema::hasColumn($table, 'sitemap_priority');
            $hasSitemapChangefreq = Schema::hasColumn($table, 'sitemap_changefreq');

            $query = $modelClass::query()->whereNotNull('slug');

            if ($hasStatus) {
                $query->where(function ($q) {
                    $q->whereNull('status')->orWhereIn('status', ['published', 'active']);
                });
            }

            if ($hasIsActive) {
                $query->where(function ($q) {
                    $q->whereNull('is_active')->orWhere('is_active', true);
                });
            }

            $query->chunk(200, function ($items) use (&$urls, $routeName, $changefreq, $priority, $hasCanonicalUrl, $hasSitemapPriority, $hasSitemapChangefreq) {
                foreach ($items as $item) {
                    if (empty($item->slug)) continue;
                    $loc = ($hasCanonicalUrl && $item->canonical_url)
                        ? $item->canonical_url
                        : route($routeName, $item->slug);

                    $urls[] = [
                        'loc'        => $this->canonicalUrl($loc),
                        'lastmod'    => optional($item->updated_at)->toAtomString(),
                        'changefreq' => ($hasSitemapChangefreq && $item->sitemap_changefreq) ? $item->sitemap_changefreq : $changefreq,
                        'priority'   => ($hasSitemapPriority && $item->sitemap_priority) ? number_format((float) $item->sitemap_priority, 1) : $priority,
                    ];
                }
            });
        } catch (\Throwable $e) {
            Log::warning("Sitemap skip {$modelClass}: " . $e->getMessage());
        }
    }

    private function canonicalUrl(string $url): string
    {
        $canonicalBase = rtrim(config('app.url', 'https://morocco-quest.com'), '/');
        $host = parse_url($canonicalBase, PHP_URL_HOST) ?: 'morocco-quest.com';
        $path = parse_url($url, PHP_URL_PATH) ?: '/';
        $query = parse_url($url, PHP_URL_QUERY);

        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        return 'https://' . $host . $path . ($query ? '?' . $query : '');
    }
}
