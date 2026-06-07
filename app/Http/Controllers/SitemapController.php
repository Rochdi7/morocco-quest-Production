<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Activity;
use App\Models\Post;
use App\Models\Blog;
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
            ['loc' => route('home'),              'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '1.0'],
            ['loc' => route('dmc.marrakech'),     'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.9'],
            ['loc' => route('about'),             'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('faq'),               'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('tours.index'),       'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '0.9'],
            ['loc' => route('activities.index'),  'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '0.9'],
            ['loc' => route('trips.index'),       'lastmod' => $now, 'changefreq' => 'daily',   'priority' => '0.9'],
            ['loc' => route('blog.index'),        'lastmod' => $now, 'changefreq' => 'weekly',  'priority' => '0.7'],
            ['loc' => route('contact.show'),      'lastmod' => $now, 'changefreq' => 'yearly',  'priority' => '0.5'],
        ];

        $this->addModel($urls, Tour::class,     'tours.show',      'weekly', '0.8');
        $this->addModel($urls, Activity::class, 'activities.show', 'weekly', '0.7');
        $this->addModel($urls, Post::class,     'blog.show',       'weekly', '0.6');
        $this->addModel($urls, Blog::class,     'blog.show',       'weekly', '0.6');

        return response()
            ->view('sitemap.index', compact('urls'))
            ->header('Content-Type', 'application/xml');
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
