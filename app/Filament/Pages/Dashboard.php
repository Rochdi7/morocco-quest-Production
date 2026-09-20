<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    // Widgets are registered in PanelProvider to avoid duplicates.
    public function getHeaderWidgets(): array
    {
        return [];
    }

    /**
     * One column at the dashboard level so each widget occupies its own full
     * row and controls its internal grid. Filament's default (2 on desktop)
     * put the AccountWidget beside LeadStats and squeezed the stat cards into
     * a narrow column, wrapping the labels.
     */
    public function getColumns(): int | string | array
    {
        return 1;
    }
}
