<?php

namespace App\Filament\Resources\ReferentieTypes\Pages;

use App\Filament\Resources\ReferentieTypes\ReferentieTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReferentieTypes extends ListRecords
{
    protected static string $resource = ReferentieTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
