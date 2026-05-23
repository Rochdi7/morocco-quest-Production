<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Tour;
use App\Models\Activity;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Place;
use App\Models\Tag;
use App\Models\ActivityCategory;

class TourStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Tours', Tour::count())
                ->description('Number of published tours')
                ->color('success')
                ->icon('heroicon-o-map'),

            Stat::make('Total Activities', Activity::count())
                ->description('Number of published activities')
                ->color('warning')
                ->icon('heroicon-o-sparkles'),

            Stat::make('Total Blogs', Blog::count())
                ->description('Number of published blog posts')
                ->color('primary')
                ->icon('heroicon-o-document-text'),


        ];
    }

    protected int | string | array $columnSpan = 'full';

    /**
     * Force display in three columns per row.
     */
    protected function getColumns(): int
    {
        return 3;
    }
}
