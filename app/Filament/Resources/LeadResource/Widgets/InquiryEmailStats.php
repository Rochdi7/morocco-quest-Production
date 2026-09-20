<?php

namespace App\Filament\Resources\LeadResource\Widgets;

use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Header stats on the Leads list: how many inquiry emails each form has
 * produced, so the volume per channel is visible without filtering the table.
 *
 * Every form submission sends one email to the sales inbox, so a row of the
 * given inquiry type is equivalent to one email sent.
 */
class InquiryEmailStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 4;
    }

    public static function canView(): bool
    {
        return auth()->user()?->canViewLeadStats() ?? false;
    }

    protected function getStats(): array
    {
        $emails = Lead::whereNotIn('type', Lead::CLICK_TYPES);

        return [
            Stat::make('Inquiry Emails Sent', $emails->count())
                ->description('All forms, all time')
                ->descriptionIcon('heroicon-m-paper-airplane')
                ->color('success'),

            Stat::make('Tour Inquiries', Lead::where('type', Lead::TYPE_TOUR_INQUIRY)->count())
                ->description($this->thisMonth(Lead::TYPE_TOUR_INQUIRY) . ' this month')
                ->descriptionIcon('heroicon-m-map')
                ->color('success'),

            Stat::make('Activity Inquiries', Lead::where('type', Lead::TYPE_ACTIVITY_INQUIRY)->count())
                ->description($this->thisMonth(Lead::TYPE_ACTIVITY_INQUIRY) . ' this month')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('info'),

            Stat::make('Contact Forms', Lead::where('type', Lead::TYPE_CONTACT_INQUIRY)->count())
                ->description($this->thisMonth(Lead::TYPE_CONTACT_INQUIRY) . ' this month')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('primary'),
        ];
    }

    private function thisMonth(string $type): int
    {
        return Lead::where('type', $type)
            ->where('created_at', '>=', now()->startOfMonth())
            ->count();
    }
}
