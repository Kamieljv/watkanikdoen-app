<?php

namespace App\Filament\Resources\Acties;

use App\Filament\Resources\Acties\Pages\CreateActie;
use App\Filament\Resources\Acties\Pages\EditActie;
use App\Filament\Resources\Acties\Pages\ListActies;
use App\Filament\Resources\Acties\Schemas\ActieForm;
use App\Filament\Resources\Acties\Tables\ActiesTable;
use App\Models\Actie;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ActieResource extends Resource
{
    protected static ?string $model = Actie::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static string | UnitEnum | null $navigationGroup = 'Acties & Organisatoren';

    protected static ?string $recordTitleAttribute = 'Actie';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return ActieForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActiesTable::configure($table);
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
            'index' => ListActies::route('/'),
            'create' => CreateActie::route('/create'),
            'edit' => EditActie::route('/{record}/edit'),
        ];
    }
}
