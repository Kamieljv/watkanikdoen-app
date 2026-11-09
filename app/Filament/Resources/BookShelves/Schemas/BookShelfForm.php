<?php

namespace App\Filament\Resources\BookShelves\Schemas;

use App\Models\BookShelf;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BookShelfForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('description')
                    ->label('Shelf Description')
                    ->helperText('Describe the overall theme or purpose of this book shelf')
                    ->rows(4)
                    ->columnSpanFull(),

                Select::make('organizer_id')
                    ->label('Organizer')
                    ->relationship('organizer', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(BookShelf::class, 'slug', fn($record) => $record),

                Section::make('Themes')
                    ->description('Select one or more themes for this book shelf')
                    ->schema([
                        Select::make('themes')
                            ->relationship('themes', 'name')
                            ->multiple()
                            ->preload()
                            ->required(),
                    ])
                    ->columnSpanFull(),

                Section::make('Books')
                    ->description('Add books to this shelf with explanations')
                    ->schema([
                        Repeater::make('bookshelfBooks')
                            ->schema([
                                Select::make('book_id')
                                    ->label('Book')
                                    ->options(\App\Models\Book::all()->pluck('title', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->columnSpan(2),
                                Textarea::make('description')
                                    ->label('Why this book?')
                                    ->helperText('Explain why this book is included on this shelf')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->addActionLabel('Add Book')
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(
                                fn(array $state): ?string =>
                                isset($state['book_id']) ? \App\Models\Book::find($state['book_id'])?->title : null
                            )
                            ->defaultItems(0)
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
