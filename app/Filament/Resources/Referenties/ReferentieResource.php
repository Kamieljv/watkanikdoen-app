<?php

namespace App\Filament\Resources\Referenties;

use App\Filament\Resources\Referenties\Pages\CreateReferentie;
use App\Filament\Resources\Referenties\Pages\EditReferentie;
use App\Filament\Resources\Referenties\Pages\ListReferenties;
use App\Filament\Resources\Referenties\Schemas\ReferentieForm;
use App\Filament\Resources\Referenties\Tables\ReferentiesTable;
use App\Models\Referentie;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReferentieResource extends Resource
{
    protected static ?string $model = Referentie::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedLink;

    protected static string | UnitEnum | null $navigationGroup = 'ActieWijzer';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return ReferentieForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferentiesTable::configure($table);
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
            'index' => ListReferenties::route('/'),
            'create' => CreateReferentie::route('/create'),
            'edit' => EditReferentie::route('/{record}/edit'),
        ];
    }
}
