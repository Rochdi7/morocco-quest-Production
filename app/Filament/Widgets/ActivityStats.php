<?php

namespace App\Filament\Widgets;

use App\Models\Activity;
use App\Models\Blog;
use App\Models\Tour;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Collection;

class ActivityStats extends ChartWidget
{
    protected static ?string $heading = 'Publishing Trend';

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 8,
    ];

    protected function getData(): array
    {
        $months = collect(range(5, 0))
            ->map(fn (int $offset) => now()->startOfMonth()->subMonths($offset))
            ->values();

        return [
            'datasets' => [
                $this->makeDataset('Tours', Tour::class, $months, '#10b981', 'rgba(16, 185, 129, 0.1)'),
                $this->makeDataset('Activities', Activity::class, $months, '#f59e0b', 'rgba(245, 158, 11, 0.1)'),
                $this->makeDataset('Blogs', Blog::class, $months, '#3b82f6', 'rgba(59, 130, 246, 0.1)'),
            ],
            'labels' => $months->map(fn (Carbon $month) => $month->format('M Y'))->all(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function makeDataset(
        string $label,
        string $modelClass,
        Collection $months,
        string $borderColor,
        string $backgroundColor
    ): array {
        $counts = $this->getMonthlyCounts($modelClass, $months->first());

        return [
            'label' => $label,
            'data' => $months
                ->map(fn (Carbon $month) => $counts[$month->format('Y-m')] ?? 0)
                ->all(),
            'borderColor' => $borderColor,
            'backgroundColor' => $backgroundColor,
            'tension' => 0.35,
            'fill' => true,
        ];
    }

    private function getMonthlyCounts(string $modelClass, Carbon $startMonth): array
    {
        return $modelClass::query()
            ->where('created_at', '>=', $startMonth->copy()->startOfMonth())
            ->get(['created_at'])
            ->groupBy(fn ($record) => Carbon::parse($record->created_at)->format('Y-m'))
            ->map(fn (Collection $records) => $records->count())
            ->all();
    }
}
