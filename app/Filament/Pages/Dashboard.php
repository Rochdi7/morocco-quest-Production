<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    /** Sits above the stats, on its own row. */
    public function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | string | array
    {
        return 1;
    }

    /**
     * One column so each widget occupies its own full row and controls its
     * internal grid. Filament's default (2 on desktop) put the AccountWidget
     * beside LeadStats and squeezed the stat cards into a narrow column,
     * wrapping the labels mid-word.
     */
    public function getColumns(): int | string | array
    {
        return 1;
    }

    /**
     * Applies the same single-column grid to the footer widgets, which is
     * where panel-registered widgets (LeadStats among them) actually render.
     * Without this they keep the panel's default multi-column layout and the
     * page-level getColumns() above has no effect on them.
     */
    public function getWidgetsColumns(): int | string | array
    {
        return 1;
    }
}
