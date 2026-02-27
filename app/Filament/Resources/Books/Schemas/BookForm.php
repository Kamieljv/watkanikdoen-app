<?php

namespace App\Filament\Resources\Books\Schemas;

use App\Http\Controllers\BookController;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Notifications\Notification;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('author')
                    ->required(),
                TextInput::make('year')
                    ->label('Publication Year')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(date('Y')),
                TextInput::make('isbn')
                    ->required()
                    ->suffixAction(
                        Action::make('fetchBookData')
                            ->icon('heroicon-o-magnifying-glass')
                            ->label('Fetch')
                            ->action(function (Set $set, $state) {
                                if (empty($state)) {
                                    Notification::make()
                                        ->warning()
                                        ->title('Please enter an ISBN first')
                                        ->send();
                                    return;
                                }
                                try {
                                    $bookData = (new BookController())->fetchBookDataByIsbn($state);
                                    $set('title', $bookData['title']);
                                    $set('description', $bookData['description']);
                                    $set('author', $bookData['author']);
                                    $set('year', $bookData['year']);
                                    $set('cover_image', $bookData['cover_image']);
                                } catch (\Exception $e) {
                                    Notification::make()
                                        ->danger()
                                        ->title('Error fetching book data')
                                        ->body($e->getMessage())
                                        ->send();
                                }
                            })
                    ),
                TextInput::make('cover_image')
                    ->label('Cover Image URL')
                    ->url(),
                Select::make('themes')
                    ->multiple()
                    ->relationship('themes', 'name')
                    ->preload(),
                Select::make('tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->preload(),
            ]);
    }
}
