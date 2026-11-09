<?php

namespace App\Filament\Resources\Dimensions\Pages;

use App\Filament\Resources\Dimensions\DimensionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDimension extends EditRecord
{
    protected static string $resource = DimensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
