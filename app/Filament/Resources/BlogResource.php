<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\BlogResource\RelationManagers\CommentsRelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $navigationGroup = 'Blogs';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Blog Articles';
    protected static ?string $pluralModelLabel = 'Blogs';
    protected static ?string $modelLabel = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!empty($state)) {
                            $set('slug', Str::slug($state));
                        }
                    }),

                Forms\Components\TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->maxLength(255)
                    ->placeholder('A brief subtitle for the blog article'),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(Blog::class, 'slug', ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('Automatically generated from the title. You can override it if needed.'),

                Forms\Components\TextInput::make('written_by')
                    ->label('Written By')
                    ->placeholder('Enter the author name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('quote')->nullable(),
                Forms\Components\TextInput::make('quote_author')->nullable(),

                Forms\Components\Textarea::make('summary')
                    ->rows(3)
                    ->nullable(),

                Forms\Components\RichEditor::make('content')
    ->toolbarButtons([
        'bold',
        'italic',
        'strike',
        'h2',
        'h3',
        'bulletList',
        'orderedList',
        'link',
        'blockquote',
        'codeBlock',
        'justifyLeft',
        'justifyCenter',
        'justifyRight',
        'justifyFull'
    ])
    ->required()
    ->label('Content')
    ->placeholder('Write your amazing content here...')
    ->columnSpanFull(),


                Forms\Components\Select::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label('Categories'),

                Forms\Components\Select::make('tags')
                    ->relationship('tags', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label('Tags'),

                Forms\Components\FileUpload::make('featured_image')
                    ->image()
                    ->directory('images/blogs')
                    ->disk('public')
                    ->preserveFilenames()
                    ->label('Featured Image')
                    ->nullable(),

                Forms\Components\TextInput::make('featured_image_caption')
                    ->label('Image Caption')
                    ->maxLength(255)
                    ->nullable(),

                Forms\Components\TextInput::make('featured_image_alt')
                    ->label('Alt Text')
                    ->maxLength(255)
                    ->nullable()
                    ->helperText('Describe the image for SEO and accessibility.'),

                Forms\Components\Textarea::make('featured_image_description')
                    ->label('Image Description')
                    ->rows(3)
                    ->nullable(),

                Forms\Components\Section::make('SEO')
                    ->description('Optional. Override the auto-generated meta title and description for search engines.')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('SEO Title')
                            ->nullable()
                            ->maxLength(70)
                            ->helperText('Max 70 characters. Leave blank to auto-generate from blog title.')
                            ->placeholder('e.g. Best Time to Visit Morocco 2025 | Morocco Quest Blog')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->nullable()
                            ->maxLength(160)
                            ->rows(3)
                            ->helperText('Max 160 characters. Leave blank to auto-generate from blog summary.')
                            ->placeholder('e.g. Discover the best time to visit Morocco by season — weather, festivals, crowds, and insider tips from a local travel expert.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }


   public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('categories.name')
                ->label('Categories')
                ->limit(3)
                ->separator(', '),

            Tables\Columns\ImageColumn::make('featured_image')
                ->label('Image')
                ->circular()
                ->getStateUsing(fn ($record) => $record->featured_image_url)
                ->defaultImageUrl(asset('assets/img/placeholder-image.webp')),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}


    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
