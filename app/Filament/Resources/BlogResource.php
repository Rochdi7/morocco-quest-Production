<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                ->getStateUsing(function ($record) {
                    if ($record->featured_image) {
                        $path = str_replace('public/', '', $record->featured_image);
                        return url('public/storage/' . $path);
                    }
                    return url('/images/placeholder-tour.jpg'); // Fallback image if not found
                })
                ->defaultImageUrl(url('/images/placeholder-tour.jpg')),

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
            // Example: RelationManagers\TagsRelationManager::class,
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
