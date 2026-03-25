<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    // Widgets are registered in PanelProvider to avoid duplicates.
    // Remove getHeaderWidgets() completely, or keep it returning an empty array:

    public function getHeaderWidgets(): array
    {
        return [];
    }
}
