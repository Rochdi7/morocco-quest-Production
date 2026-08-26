<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

/**
 * Every inbound signal in one list: tour/activity/contact form submissions
 * plus WhatsApp and phone clicks. Filter by `type` to isolate one channel.
 */
class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationLabel = 'Reservations & Leads';
    protected static ?string $navigationGroup = 'Leads';
    protected static ?string $modelLabel = 'Lead';
    protected static ?int $navigationSort = 1;

    /** Badge shows how many form leads still need a reply. */
    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'new')
            ->whereNotIn('type', Lead::CLICK_TYPES)
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        // Only the pipeline status is editable — the rest is visitor-submitted
        // data and should stay exactly as captured.
        return $form->schema([
            Forms\Components\Select::make('status')
                ->options(Lead::STATUS_LABELS)
                ->required()
                ->native(false),
            Forms\Components\TextInput::make('name')->disabled(),
            Forms\Components\TextInput::make('email')->disabled(),
            Forms\Components\TextInput::make('phone')->disabled(),
            Forms\Components\Textarea::make('message')->disabled()->columnSpanFull()->rows(6),
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make('Request')
                ->columns(3)
                ->schema([
                    Infolists\Components\TextEntry::make('type')
                        ->badge()
                        ->formatStateUsing(fn (?string $state) => Lead::TYPE_LABELS[$state] ?? $state),
                    Infolists\Components\TextEntry::make('status')
                        ->badge()
                        ->formatStateUsing(fn (?string $state) => Lead::STATUS_LABELS[$state] ?? $state),
                    Infolists\Components\TextEntry::make('created_at')->dateTime('Y-m-d H:i'),
                    Infolists\Components\TextEntry::make('item_title')->label('Tour / Activity')->placeholder('-'),
                    Infolists\Components\TextEntry::make('source')->label('Page / slug')->placeholder('-'),
                ]),

            Infolists\Components\Section::make('Contact')
                ->columns(3)
                ->visible(fn (Lead $record) => ! $record->isClick())
                ->schema([
                    Infolists\Components\TextEntry::make('name')->placeholder('-'),
                    Infolists\Components\TextEntry::make('email')->copyable()->placeholder('-'),
                    Infolists\Components\TextEntry::make('phone')->copyable()->placeholder('-'),
                    Infolists\Components\TextEntry::make('nationality')->placeholder('-'),
                ]),

            Infolists\Components\Section::make('Trip details')
                ->columns(4)
                ->visible(fn (Lead $record) => ! $record->isClick())
                ->schema([
                    Infolists\Components\TextEntry::make('arrival_date')->date('Y-m-d')->placeholder('-'),
                    Infolists\Components\TextEntry::make('duration_days')->label('Duration')->placeholder('-'),
                    Infolists\Components\TextEntry::make('adults')->placeholder('-'),
                    Infolists\Components\TextEntry::make('children')->placeholder('-'),
                    Infolists\Components\TextEntry::make('message')->columnSpanFull()->placeholder('-'),
                ]),

            Infolists\Components\Section::make('Visitor')
                ->columns(3)
                ->collapsed()
                ->schema([
                    Infolists\Components\TextEntry::make('ip_address')->label('IP address')->copyable()->placeholder('-'),
                    Infolists\Components\TextEntry::make('browser')->placeholder('-'),
                    Infolists\Components\TextEntry::make('platform')->placeholder('-'),
                    Infolists\Components\TextEntry::make('device')->placeholder('-'),
                    Infolists\Components\TextEntry::make('page_url')->label('Page URL')->columnSpan(2)->placeholder('-'),
                    Infolists\Components\TextEntry::make('referrer')->columnSpanFull()->placeholder('-'),
                    Infolists\Components\TextEntry::make('user_agent')->label('User agent')->columnSpanFull()->placeholder('-'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (?string $state) => Lead::TYPE_LABELS[$state] ?? $state)
                    ->color(fn (?string $state) => match ($state) {
                        Lead::TYPE_TOUR_INQUIRY     => 'success',
                        Lead::TYPE_ACTIVITY_INQUIRY => 'info',
                        Lead::TYPE_CONTACT_INQUIRY  => 'primary',
                        Lead::TYPE_WHATSAPP_CLICK   => 'warning',
                        default                     => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')->searchable()->placeholder('-'),
                Tables\Columns\TextColumn::make('email')->searchable()->copyable()->placeholder('-'),
                Tables\Columns\TextColumn::make('phone')->searchable()->copyable()->placeholder('-'),

                Tables\Columns\TextColumn::make('item_title')
                    ->label('Tour / Activity')
                    ->limit(35)
                    ->searchable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('source')
                    ->label('Page')
                    ->limit(25)
                    ->searchable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('arrival_date')
                    ->date('Y-m-d')
                    ->sortable()
                    ->toggleable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP')
                    ->searchable()
                    ->toggleable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('browser')->toggleable()->placeholder('-'),
                Tables\Columns\TextColumn::make('platform')->toggleable(isToggledHiddenByDefault: true)->placeholder('-'),
                Tables\Columns\TextColumn::make('device')->toggleable(isToggledHiddenByDefault: true)->placeholder('-'),

                Tables\Columns\SelectColumn::make('status')
                    ->options(Lead::STATUS_LABELS)
                    ->selectablePlaceholder(false),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(Lead::TYPE_LABELS)
                    ->multiple()
                    ->label('Type'),

                SelectFilter::make('status')
                    ->options(Lead::STATUS_LABELS)
                    ->label('Status'),

                Filter::make('forms_only')
                    ->label('Forms only (hide clicks)')
                    ->query(fn (Builder $query) => $query->whereNotIn('type', Lead::CLICK_TYPES)),

                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('From'),
                        Forms\Components\DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'] ?? null, fn ($q, $d) => $q->whereDate('created_at', '>=', $d))
                            ->when($data['until'] ?? null, fn ($q, $d) => $q->whereDate('created_at', '<=', $d));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'view'  => Pages\ViewLead::route('/{record}'),
        ];
    }
}
