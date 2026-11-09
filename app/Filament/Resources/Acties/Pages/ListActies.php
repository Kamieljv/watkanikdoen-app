<?php

namespace App\Filament\Resources\Acties\Pages;

use App\Filament\Resources\Acties\ActieResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListActies extends ListRecords
{
    protected static string $resource = ActieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
