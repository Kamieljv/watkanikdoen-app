<?php

namespace App\Filament\Resources\Dimensions\Pages;

use App\Filament\Resources\Dimensions\DimensionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDimensions extends ListRecords
{
    protected static string $resource = DimensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
