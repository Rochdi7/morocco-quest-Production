<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use App\Providers\Filament\AdminPanelPanelProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // ❌ REMOVE THIS LINE - it causes the error
        // Filament::registerPanel(AdminPanelPanelProvider::class);

        // ✅ Instead, register panel providers via $this->app->register(...)
        $this->app->register(AdminPanelPanelProvider::class);
    }

    public function boot(): void
    {
        //
    }
}
