<?php

namespace App\Filament\Resources\Books\Schemas;

use App\Http\Controllers\BookController;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;

class BookForm
{
    /**
     * Fill the form with the data of the search result the user picked.
     */
    protected static function fillFromSearchResult()
    {
        return function (Set $set, ?string $state) {
            if (empty($state)) {
                return;
            }
            try {
                $controller = new BookController();
                $bookData = $controller->fetchBookDataByCandidate($state);
                $set('title', $bookData['title']);
                $set('description', $bookData['description']);
                $set('isbn', $bookData['isbn']);
                $set('author', $bookData['author']);
                $set('year', $bookData['year']);
                $set('publisher', $bookData['publisher']);

                if (!empty($bookData['cover_image'])) {
                    $storagePath = $controller->downloadCoverImage(
                        $bookData['cover_image'],
                        $bookData['isbn'] ?? $bookData['title'],
                    );
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
                Section::make('Search by title')
                    ->description('Search OpenLibrary (or Big Book API if OpenLibrary finds nothing) by title, then pick a result to fill in the form. Missing fields are completed from OpenLibrary, Hardcover and De Slegte by ISBN.')
                    ->schema([
                        Select::make('search_title')
                            ->label('Search by title')
                            ->placeholder('Type a title...')
                            ->searchable()
                            ->searchDebounce(600)
                            ->searchPrompt('Type at least 3 characters')
                            ->noSearchResultsMessage('No books found')
                            ->getSearchResultsUsing(function (string $search): array {
                                if (mb_strlen(trim($search)) < 3) {
                                    return [];
                                }
                                return (new BookController())->searchBooksByTitle($search);
                            })
                            ->getOptionLabelUsing(fn($value) => (new BookController())->getCandidateLabel($value))
                            ->live()
                            ->afterStateUpdated(self::fillFromSearchResult())
                            ->dehydrated(false),
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
