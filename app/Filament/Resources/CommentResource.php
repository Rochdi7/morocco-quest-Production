<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Blog;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left';
    protected static ?string $navigationLabel = 'Comments';
    protected static ?string $navigationGroup = 'Blogs'; // Optional: match existing groups like in your sidebar

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email(),
                Forms\Components\Textarea::make('content')->required()->columnSpanFull(),
                Forms\Components\Select::make('blog_id')
                    ->relationship('blog', 'title')
                    ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('content')->limit(60)->wrap(),
                Tables\Columns\TextColumn::make('blog.title')->label('Blog')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('parent_id')->label('Reply to #')->placeholder('—'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('Y-m-d H:i')->sortable(),
            ])
            ->filters([
                SelectFilter::make('blog_id')
                    ->label('Blog Post')
                    ->options(Blog::pluck('title', 'id'))
                    ->searchable()
                    ->placeholder('All blogs'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // ✅ Make sure delete action is available
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }

    // Optional: always register in navigation
    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
