<?php

namespace App\Providers\Filament;

use App\Filament\Resources\BlogResource\RelationManagers\CommentsRelationManager;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use App\Filament\Widgets\TourStats;
use App\Filament\Widgets\TripStats;
use App\Filament\Widgets\ActivityStats;
use App\Filament\Widgets\WebsiteVisits;
use Livewire\Livewire;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelPanelProvider extends PanelProvider
{
    public function register(): void
    {
        parent::register();

        // Explicit alias so Livewire resolves this on POST /livewire/update
        // regardless of opcache or autoload classmap state on production
        Livewire::component(
            'app.filament.resources.blog-resource.relation-managers.comments-relation-manager',
            CommentsRelationManager::class
        );
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('adminPanel')
            ->path('adminPanel')
            ->login()

            ->colors([
                'primary' => Color::hex('#bb5e2a'),
            ])

            ->brandLogo('https://morocco-quest.com/assets/img/logo-bg-wide.webp')
            ->brandLogoHeight('40px')
            ->favicon(asset('favicon.ico'))

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')

            ->widgets([
                AccountWidget::class,
            ])

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
