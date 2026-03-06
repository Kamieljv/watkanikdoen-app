<?php

namespace App\Filament\Resources\Books\Schemas;

use App\Http\Controllers\BookController;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Illuminate\Support\HtmlString;

class BookForm
{
    protected static function searchAction()
    {
        return function (Set $set, $state) {
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
                $set('isbn', $bookData['isbn']);
                $set('author', $bookData['author']);
                $set('year', $bookData['year']);
                $set('publisher', $bookData['publisher']);
                $set('cover_image', $bookData['cover_image']);
            } catch (\Exception $e) {
                Notification::make()
                    ->danger()
                    ->title('Error fetching book data')
                    ->body($e->getMessage())
                    ->send();
            }
        };
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Search by ISBN')
                    ->description('Enter an ISBN to fetch book data from OpenLibrary')
                    ->schema([
                        TextInput::make('search_isbn')
                            ->label('Search by ISBN')
                            ->suffixAction(
                                Action::make('fetchBookData')
                                    ->icon('heroicon-o-magnifying-glass')
                                    ->label('Fetch')
                                    ->action(self::searchAction())
                            )
                    ])
                    ->columnSpan(1),
                TextInput::make('title')
                    ->required()
                    ->columnStart(1),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('author')
                    ->required(),
                TextInput::make('year')
                    ->label('Publication Year')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(date('Y')),
                TextInput::make('publisher')
                    ->label('Publisher'),
                TextInput::make('isbn')
                    ->required(),
                TextInput::make('cover_image')
                    ->label('Cover Image URL')
                    ->url()
                    ->live(debounce: 500),
                Placeholder::make('cover_preview')
                    ->label('Cover Preview')
                    ->content(fn (Get $get): HtmlString|string => $get('cover_image')
                        ? new HtmlString('<img src="' . e($get('cover_image')) . '" alt="Cover preview" style="max-width:300px; border-radius:4px;" />')
                        : '—'
                    ),
                
                Section::make('Categorization')
                    ->schema([
                        Select::make('themes')
                            ->multiple()
                            ->relationship('themes', 'name')
                            ->preload(),
                        Select::make('tags')
                            ->multiple()
                            ->relationship('tags', 'name')
                            ->preload(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
