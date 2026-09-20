<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\LeadResource;
use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

/**
 * Funnel overview for the dashboard: form leads, WhatsApp/phone clicks and
 * pipeline status, each with a 30-day trend line.
 *
 * Visible only to users flagged as lead viewers (see User::canViewLeadStats).
 */
class LeadStats extends BaseWidget
{
    protected static ?int $sort = -10;

    protected int | string | array $columnSpan = 'full';

    /**
     * Stats are short enough to sit 3-up on desktop; drop to 2 on tablet and
     * 1 on phones so the labels never wrap mid-word.
     */
    protected function getColumns(): int
    {
        return 3;
    }

    public static function canView(): bool
    {
        return auth()->user()?->canViewLeadStats() ?? false;
    }

    /**
     * Deep link into the Leads table, pre-filtered. Clicking a card opens the
     * matching list rather than a modal, so the records arrive with search,
     * sorting and the full detail view already available.
     */
    private function tab(string $tab, array $params = []): string
    {
        return LeadResource::getUrl('index', ['activeTab' => $tab] + $params);
    }

    protected function getStats(): array
    {
        $formLeads = fn () => Lead::whereNotIn('type', Lead::CLICK_TYPES);

        return [
            Stat::make('Form Leads', $formLeads()->count())
                ->description($this->since($formLeads(), 30) . ' new this month')
                ->descriptionIcon('heroicon-m-envelope')
                ->chart($this->trend($formLeads()))
                ->url($this->tab('inquiries'))
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->color('success'),

            Stat::make('WhatsApp Clicks', Lead::where('type', Lead::TYPE_WHATSAPP_CLICK)->count())
                ->description($this->since(Lead::where('type', Lead::TYPE_WHATSAPP_CLICK), 30) . ' this month')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->chart($this->trend(Lead::where('type', Lead::TYPE_WHATSAPP_CLICK)))
                ->url($this->tab('whatsapp'))
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->color('success'),

            Stat::make('Phone Clicks', Lead::where('type', Lead::TYPE_PHONE_CLICK)->count())
                ->description($this->since(Lead::where('type', Lead::TYPE_PHONE_CLICK), 30) . ' this month')
                ->descriptionIcon('heroicon-m-phone')
                ->chart($this->trend(Lead::where('type', Lead::TYPE_PHONE_CLICK)))
                ->url($this->tab('phone'))
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->color('warning'),

            Stat::make('Tour Inquiries', Lead::where('type', Lead::TYPE_TOUR_INQUIRY)->count())
                ->description('From tour pages')
                ->descriptionIcon('heroicon-m-map')
                ->url($this->tab('inquiries', ['tableFilters[type][values][0]' => Lead::TYPE_TOUR_INQUIRY]))
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->color('success'),

            Stat::make('Activity Inquiries', Lead::where('type', Lead::TYPE_ACTIVITY_INQUIRY)->count())
                ->description('From activity pages')
                ->descriptionIcon('heroicon-m-sparkles')
                ->url($this->tab('inquiries', ['tableFilters[type][values][0]' => Lead::TYPE_ACTIVITY_INQUIRY]))
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->color('info'),

            Stat::make('Contact Forms', Lead::where('type', Lead::TYPE_CONTACT_INQUIRY)->count())
                ->description('Contact and B2B')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->url($this->tab('inquiries', ['tableFilters[type][values][0]' => Lead::TYPE_CONTACT_INQUIRY]))
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->color('primary'),

            Stat::make('To Contact', $formLeads()->where('status', 'new')->count())
                ->description('Awaiting a reply')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->url($this->tab('inquiries', ['tableFilters[status][value]' => 'new']))
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->color('danger'),

            Stat::make('Converted', $formLeads()->where('status', 'converted')->count())
                ->description($this->conversionRate() . ' conversion rate')
                ->descriptionIcon('heroicon-m-check-badge')
                ->url($this->tab('inquiries', ['tableFilters[status][value]' => 'converted']))
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->color('success'),

            Stat::make('Total Signals', Lead::count())
                ->description('Forms and clicks, all time')
                ->descriptionIcon('heroicon-m-signal')
                ->url($this->tab('all'))
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->color('gray'),
        ];
    }

    /**
     * Count within the last N days for a fresh query builder.
     */
    private function since($query, int $days): int
    {
        return $query->where('created_at', '>=', now()->subDays($days))->count();
    }

    /**
     * Daily counts for the last 30 days, oldest first, for the sparkline.
     */
    private function trend($query): array
    {
        $counts = $query
            ->where('created_at', '>=', now()->subDays(30)->startOfDay())
            ->get(['created_at'])
            ->groupBy(fn ($row) => Carbon::parse($row->created_at)->toDateString())
            ->map->count();

        $series = [];

        for ($i = 29; $i >= 0; $i--) {
            $series[] = $counts[now()->subDays($i)->toDateString()] ?? 0;
        }

        return $series;
    }

    private function conversionRate(): string
    {
        $total = Lead::whereNotIn('type', Lead::CLICK_TYPES)->count();

        if ($total === 0) {
            return '0%';
        }

        $converted = Lead::whereNotIn('type', Lead::CLICK_TYPES)
            ->where('status', 'converted')
            ->count();

        return round($converted / $total * 100, 1) . '%';
    }
}
