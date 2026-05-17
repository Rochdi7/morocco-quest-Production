<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
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
    }
}
