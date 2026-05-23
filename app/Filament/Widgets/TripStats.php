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

    protected int | string | array $columnSpan = 'full';

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
                    '#16a34a',
                    '#ea580c',
                    '#2563eb',
                    '#7c3aed',
                    '#0f766e',
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
