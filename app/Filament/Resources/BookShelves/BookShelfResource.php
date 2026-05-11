<?php

namespace App\Filament\Resources\BookShelves;

use App\Filament\Resources\BookShelves\Pages\CreateBookShelf;
use App\Filament\Resources\BookShelves\Pages\EditBookShelf;
use App\Filament\Resources\BookShelves\Pages\ListBookShelves;
use App\Filament\Resources\BookShelves\Schemas\BookShelfForm;
use App\Filament\Resources\BookShelves\Tables\BookShelvesTable;
use App\Models\BookShelf;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BookShelfResource extends Resource
{
    protected static ?string $model = BookShelf::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static string|UnitEnum|null $navigationGroup = 'Resources';

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return BookShelfForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookShelvesTable::configure($table);
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
            'index' => ListBookShelves::route('/'),
            'create' => CreateBookShelf::route('/create'),
            'edit' => EditBookShelf::route('/{record}/edit'),
        ];
    }
}
