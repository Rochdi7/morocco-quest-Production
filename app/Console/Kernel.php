<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Clear and rebuild caches daily at 01:00 AM
        $schedule->command('route:clear')->dailyAt('01:00');
        $schedule->command('view:clear')->dailyAt('01:01');
        $schedule->command('config:clear')->dailyAt('01:02');
        $schedule->command('cache:clear')->dailyAt('01:03');

        $schedule->command('route:cache')->dailyAt('01:10');
        $schedule->command('view:cache')->dailyAt('01:11');
        $schedule->command('config:cache')->dailyAt('01:12');

        // Generate sitemap daily at 02:00 AM
        $schedule->call(function () {
            (new \App\Http\Controllers\SitemapController)->index();
            \Log::info('✅ Sitemap generated successfully at ' . now());
        })->dailyAt('02:00');

        // Optional: schedule HTML minification check or custom tasks here
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
