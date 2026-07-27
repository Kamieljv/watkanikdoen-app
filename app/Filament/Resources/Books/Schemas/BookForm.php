<?php

namespace App\Filament\Resources\Books\Schemas;

use App\Http\Controllers\BookController;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;

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
                $controller = new BookController();
                $bookData = $controller->fetchBookDataByIsbn($state);
                $set('title', $bookData['title']);
                $set('description', $bookData['description']);
                $set('isbn', $bookData['isbn']);
                $set('author', $bookData['author']);
                $set('year', $bookData['year']);
                $set('publisher', $bookData['publisher']);

                if (!empty($bookData['cover_image'])) {
                    $storagePath = $controller->downloadCoverImage($bookData['cover_image'], $bookData['isbn']);
                    if ($storagePath) {
                        $set('image_upload', [$storagePath]);
                    }
                }
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
                    ->description('Enter an ISBN to fetch book data from OpenLibrary, HardCover and De Slegte')
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
                FileUpload::make('image_upload')
                    ->label('Cover Image')
                    ->disk('public')
                    ->image()
                    ->imageEditor()
                    ->directory('books')
                    ->columnSpan(2),

                Section::make('Categorization')
                    ->schema([
                        Select::make('themes')
                            ->multiple()
                            ->relationship('themes', 'name')
                            ->preload(),
                        Select::make('tags')
                            ->multiple()
                            ->relationship('tags', 'name')
                            ->createOptionForm([
                                TextInput::make('name')->required(),
                            ])
                            ->preload(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
