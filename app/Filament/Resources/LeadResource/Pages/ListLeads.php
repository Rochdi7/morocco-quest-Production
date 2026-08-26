<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Filament\Resources\LeadResource;
use App\Models\Lead;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListLeads extends ListRecords
{
    protected static string $resource = LeadResource::class;

    /** Quick tabs so clicks and form leads can be reviewed separately. */
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),

            'inquiries' => Tab::make('Form inquiries')
                ->modifyQueryUsing(fn (Builder $q) => $q->whereNotIn('type', Lead::CLICK_TYPES))
                ->badge(Lead::whereNotIn('type', Lead::CLICK_TYPES)->count()),

            'whatsapp' => Tab::make('WhatsApp clicks')
                ->modifyQueryUsing(fn (Builder $q) => $q->where('type', Lead::TYPE_WHATSAPP_CLICK))
                ->badge(Lead::where('type', Lead::TYPE_WHATSAPP_CLICK)->count()),

            'phone' => Tab::make('Phone clicks')
                ->modifyQueryUsing(fn (Builder $q) => $q->where('type', Lead::TYPE_PHONE_CLICK))
                ->badge(Lead::where('type', Lead::TYPE_PHONE_CLICK)->count()),
        ];
    }
}
