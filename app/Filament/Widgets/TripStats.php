<?php

namespace App\Filament\Widgets;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Place;
use App\Models\Tour;
use Filament\Widgets\ChartWidget;

class TripStats extends ChartWidget
{
    protected static ?string $heading = 'Content Breakdown';

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 4,
    ];

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        return [
            'datasets' => [[
                'data' => [
                    Tour::count(),
                    Activity::count(),
                    Blog::count(),
                    Place::count(),
                    Category::count() + ActivityCategory::count(),
                ],
                'backgroundColor' => [
                    '#10b981', // Emerald 500
                    '#f59e0b', // Amber 500
                    '#3b82f6', // Blue 500
                    '#8b5cf6', // Violet 500
                    '#06b6d4', // Cyan 500
                ],
            ]],
            'labels' => [
                'Tours',
                'Activities',
                'Blogs',
                'Destinations',
                'Categories',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
