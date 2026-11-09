<?php

namespace App\Filament\Resources\Referenties\Pages;

use App\Filament\Resources\Referenties\ReferentieResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReferenties extends ListRecords
{
    protected static string $resource = ReferentieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
