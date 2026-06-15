<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WebsiteVisits extends ChartWidget
{
    protected static ?string $heading = 'Engagement (Last 30 Days)';

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $days    = 30;
        $start   = now()->subDays($days - 1)->startOfDay();
        $end     = now()->endOfDay();
        $period  = CarbonPeriod::create($start, '1 day', $end);
        $labels  = collect($period)->map(fn (Carbon $d) => $d->format('d M'))->all();

        $comments   = $this->countPerDay(Comment::class, $start, $end);
        $inquiries  = $this->countPerDayFromTable('contact_submissions', $start, $end);

        return [
            'datasets' => [
                [
                    'label'           => 'Comments',
                    'data'            => collect($period)
                        ->map(fn (Carbon $d) => $comments[$d->format('Y-m-d')] ?? 0)
                        ->all(),
                    'borderColor'     => '#8b5cf6',
                    'backgroundColor' => 'rgba(139, 92, 246, 0.1)',
                    'fill'            => 'start',
                    'tension'         => 0.4,
                ],
                [
                    'label'           => 'Inquiries',
                    'data'            => collect($period)
                        ->map(fn (Carbon $d) => $inquiries[$d->format('Y-m-d')] ?? 0)
                        ->all(),
                    'borderColor'     => '#06b6d4',
                    'backgroundColor' => 'rgba(6, 182, 212, 0.1)',
                    'fill'            => 'start',
                    'tension'         => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => ['legend' => ['display' => true]],
            'scales' => [
                'y' => ['beginAtZero' => true, 'grid' => ['display' => false], 'ticks' => ['precision' => 0]],
                'x' => ['grid' => ['display' => false]],
            ],
        ];
    }

    private function countPerDay(string $modelClass, Carbon $start, Carbon $end): array
    {
        return $modelClass::query()
            ->whereBetween('created_at', [$start, $end])
            ->get(['created_at'])
            ->groupBy(fn ($r) => Carbon::parse($r->created_at)->format('Y-m-d'))
            ->map(fn ($g) => $g->count())
            ->all();
    }

    private function countPerDayFromTable(string $table, Carbon $start, Carbon $end): array
    {
        if (! Schema::hasTable($table)) {
            return [];
        }

        return DB::table($table)
            ->whereBetween('created_at', [$start, $end])
            ->get(['created_at'])
            ->groupBy(fn ($r) => Carbon::parse($r->created_at)->format('Y-m-d'))
            ->map(fn ($g) => $g->count())
            ->all();
    }
}
