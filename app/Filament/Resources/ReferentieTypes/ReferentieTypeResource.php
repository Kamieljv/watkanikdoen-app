<?php

namespace App\Filament\Resources\ReferentieTypes;

use App\Filament\Resources\ReferentieTypes\Pages\CreateReferentieType;
use App\Filament\Resources\ReferentieTypes\Pages\EditReferentieType;
use App\Filament\Resources\ReferentieTypes\Pages\ListReferentieTypes;
use App\Filament\Resources\ReferentieTypes\Schemas\ReferentieTypeForm;
use App\Filament\Resources\ReferentieTypes\Tables\ReferentieTypesTable;
use App\Models\ReferentieType;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReferentieTypeResource extends Resource
{
    protected static ?string $model = ReferentieType::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedWallet;

    protected static string | UnitEnum | null $navigationGroup = 'ActieWijzer';

    protected static ?string $recordTitleAttribute = 'ReferentieType';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return ReferentieTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReferentieTypesTable::configure($table);
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
            'index' => ListReferentieTypes::route('/'),
            'create' => CreateReferentieType::route('/create'),
            'edit' => EditReferentieType::route('/{record}/edit'),
        ];
    }
}
