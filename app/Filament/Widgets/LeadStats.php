<?php

namespace App\Filament\Widgets;

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

    public static function canView(): bool
    {
        return auth()->user()?->canViewLeadStats() ?? false;
    }

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        $formLeads = Lead::whereNotIn('type', Lead::CLICK_TYPES);

        return [
            Stat::make('Form Leads', (clone $formLeads)->count())
                ->description($this->since((clone $formLeads), 30) . ' in the last 30 days')
                ->descriptionIcon('heroicon-m-envelope')
                ->chart($this->trend(Lead::whereNotIn('type', Lead::CLICK_TYPES)))
                ->color('success')
                ->icon('heroicon-o-inbox-arrow-down'),

            Stat::make('WhatsApp Clicks', Lead::where('type', Lead::TYPE_WHATSAPP_CLICK)->count())
                ->description($this->since(Lead::where('type', Lead::TYPE_WHATSAPP_CLICK), 30) . ' in the last 30 days')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->chart($this->trend(Lead::where('type', Lead::TYPE_WHATSAPP_CLICK)))
                ->color('success')
                ->icon('heroicon-o-chat-bubble-oval-left-ellipsis'),

            Stat::make('Phone Clicks', Lead::where('type', Lead::TYPE_PHONE_CLICK)->count())
                ->description($this->since(Lead::where('type', Lead::TYPE_PHONE_CLICK), 30) . ' in the last 30 days')
                ->descriptionIcon('heroicon-m-phone')
                ->chart($this->trend(Lead::where('type', Lead::TYPE_PHONE_CLICK)))
                ->color('warning')
                ->icon('heroicon-o-phone-arrow-up-right'),

            Stat::make('Tour Inquiries', Lead::where('type', Lead::TYPE_TOUR_INQUIRY)->count())
                ->description('Emails sent from tour pages')
                ->color('success')
                ->icon('heroicon-o-map'),

            Stat::make('Activity Inquiries', Lead::where('type', Lead::TYPE_ACTIVITY_INQUIRY)->count())
                ->description('Emails sent from activity pages')
                ->color('info')
                ->icon('heroicon-o-sparkles'),

            Stat::make('Contact / B2B Forms', Lead::where('type', Lead::TYPE_CONTACT_INQUIRY)->count())
                ->description('Emails sent from contact forms')
                ->color('primary')
                ->icon('heroicon-o-building-office-2'),

            Stat::make('New / Unhandled', (clone $formLeads)->where('status', 'new')->count())
                ->description('Form leads still to contact')
                ->color('danger')
                ->icon('heroicon-o-exclamation-circle'),

            Stat::make('Converted', (clone $formLeads)->where('status', 'converted')->count())
                ->description($this->conversionRate() . ' of all form leads')
                ->color('success')
                ->icon('heroicon-o-check-badge'),

            Stat::make('Total Signals', Lead::count())
                ->description('Forms + clicks, all time')
                ->color('gray')
                ->icon('heroicon-o-signal'),
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
