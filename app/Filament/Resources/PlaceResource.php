<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaceResource\Pages;
use App\Models\Place;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class PlaceResource extends Resource
{
    protected static ?string $navigationGroup = 'Tours';

    protected static ?string $model = Place::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Places';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 🔹 Name Field - Reactively updates the slug
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->reactive() // ✅ Makes it reactive
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state)) {
                            $set('slug', Str::slug($state));
                        }
                    }),

                // 🔹 Slug Field - Auto-fills and is unique
                TextInput::make('slug')
                    ->required()
                    ->unique(Place::class, 'slug', ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('Automatically generated from the name. You can override it if needed.'),

                // 🔹 Image Upload
                FileUpload::make('image_path')
                    ->image()
                    ->directory('places')
                    ->label('Image'),

                // 🔹 Description
                Textarea::make('description')
                    ->maxLength(1000),

                // 🔹 Tours Selection
                Select::make('tours')
                    ->multiple()
                    ->relationship('tours', 'title')
                    ->preload(),
            ]);
    }

   public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name')->searchable()->sortable(),
            
            ImageColumn::make('image_path')
                ->label('Image')
                ->circular()
                ->getStateUsing(function ($record) {
                    if ($record->image_path) {
                        $path = str_replace('public/', '', $record->image_path);
                        return url('public/storage/' . $path);
                    }
                    return url('/images/placeholder-tour.jpg'); // Fallback image
                })
                ->defaultImageUrl(url('/images/placeholder-tour.jpg')), // Ensure placeholder image exists or replace with your own
                
            TextColumn::make('slug'),
            TextColumn::make('tours.title')
                ->label('Tours')
                ->limitList(2)
                ->separator(', '),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlaces::route('/'),
            'create' => Pages\CreatePlace::route('/create'),
            'edit' => Pages\EditPlace::route('/{record}/edit'),
        ];
    }
}
