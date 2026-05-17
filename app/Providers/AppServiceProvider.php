<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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
    }
}
