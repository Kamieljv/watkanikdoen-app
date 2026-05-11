<?php

namespace App\Filament\Resources\BookShelves\Pages;

use App\Filament\Resources\BookShelves\BookShelfResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookShelves extends ListRecords
{
    protected static string $resource = BookShelfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
