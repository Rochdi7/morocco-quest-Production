<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Activity;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->toAtomString();

        $urls = [
            [
                'loc' => route('home'),
                'lastmod' => $now,
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => route('about'),
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('faq'),
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('tours.index'),
                'lastmod' => $now,
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
            [
                'loc' => route('activities.index'),
                'lastmod' => $now,
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
            [
                'loc' => route('trips.index'),
                'lastmod' => $now,
                'changefreq' => 'daily',
                'priority' => '0.9',
            ],
            [
                'loc' => route('blog.index'),
                'lastmod' => $now,
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ],
            [
                'loc' => route('contact.show'),
                'lastmod' => $now,
                'changefreq' => 'yearly',
                'priority' => '0.5',
            ],
        ];

        $this->addTours($urls);
        $this->addActivities($urls);
        $this->addPosts($urls);

        return response()
            ->view('sitemap.index', compact('urls'))
            ->header('Content-Type', 'application/xml');
    }

    private function addTours(array &$urls): void
    {
        if (!Route::has('tours.show')) {
            return;
        }

        Tour::query()
            ->whereNotNull('slug')
            ->where(function ($q) {
                $q->whereNull('status')
                  ->orWhereIn('status', ['published', 'active']);
            })
            ->chunk(200, function ($tours) use (&$urls) {
                foreach ($tours as $tour) {
                    $urls[] = [
                        'loc' => route('tours.show', $tour->slug),
                        'lastmod' => optional($tour->updated_at)->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.8',
                    ];
                }
            });
    }

    private function addActivities(array &$urls): void
    {
        if (!Route::has('activities.show')) {
            return;
        }

        Activity::query()
            ->whereNotNull('slug')
            ->where(function ($q) {
                $q->whereNull('status')
                  ->orWhereIn('status', ['published', 'active']);
            })
            ->chunk(200, function ($activities) use (&$urls) {
                foreach ($activities as $activity) {
                    $urls[] = [
                        'loc' => route('activities.show', $activity->slug),
                        'lastmod' => optional($activity->updated_at)->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.7',
                    ];
                }
            });
    }

    private function addPosts(array &$urls): void
    {
        if (!Route::has('blog.show')) {
            return;
        }

        Post::query()
            ->whereNotNull('slug')
            ->where(function ($q) {
                $q->whereNull('status')
                  ->orWhereIn('status', ['published', 'active']);
            })
            ->chunk(200, function ($posts) use (&$urls) {
                foreach ($posts as $post) {
                    $urls[] = [
                        'loc' => route('blog.show', $post->slug),
                        'lastmod' => optional($post->updated_at)->toAtomString(),
                        'changefreq' => 'weekly',
                        'priority' => '0.6',
                    ];
                }
            });
    }
}
