<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\Activity;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Tour;
use App\Providers\Filament\AdminPanelPanelProvider;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(AdminPanelPanelProvider::class);
    }

    public function boot(): void
    {
        // Defensive default canonical + og:url for every web request so that
        // SEOMeta::generate() / OpenGraph::generate() always emit exactly one
        // <link rel="canonical"> and one <meta property="og:url">. Controllers
        // that call setCanonical()/setUrl() simply override these.
        if (! $this->app->runningInConsole()) {
            $url = URL::current();
            SEOMeta::setCanonical($url);
            OpenGraph::setUrl($url);
        }

        // Bust the blog sidebar cache whenever admin edits a blog, category,
        // or tag in Filament so the change appears immediately. The cache
        // also auto-expires after 1h, so this is a UX nicety, not a
        // correctness requirement.
        $bust = function () {
            Cache::forget('blog_sidebar_v1');
        };
        Blog::saved($bust);
        Blog::deleted($bust);
        Category::saved($bust);
        Category::deleted($bust);
        Tag::saved($bust);
        Tag::deleted($bust);

        // Share a small list of tour + activity slugs/titles with the footer
        // partial so every page renders inlinks to detail pages. This fixes
        // the Ahrefs "Page has only one dofollow incoming internal link" issue
        // for tour/place/{slug} and activities/{slug} detail pages.
        //
        // Cached for 6h. Auto-busted below when a Tour or Activity is saved.
        View::composer('partials.footer', function ($view) {
            $data = Cache::remember('footer_inlinks_v1', 21600, function () {
                return [
                    'footerTours' => Tour::query()
                        ->select('id', 'slug', 'title')
                        ->latest('id')
                        ->take(6)
                        ->get(),
                    'footerActivities' => Activity::query()
                        ->select('id', 'slug', 'title')
                        ->latest('id')
                        ->take(6)
                        ->get(),
                ];
            });
            $view->with($data);
        });

        $bustFooter = function () {
            Cache::forget('footer_inlinks_v1');
        };
        Tour::saved($bustFooter);
        Tour::deleted($bustFooter);
        Activity::saved($bustFooter);
        Activity::deleted($bustFooter);
    }
}
