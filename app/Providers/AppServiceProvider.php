<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\Filament\AdminPanelPanelProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(AdminPanelPanelProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
