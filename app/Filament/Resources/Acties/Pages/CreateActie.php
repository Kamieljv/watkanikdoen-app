<?php

namespace App\Filament\Resources\Acties\Pages;

use App\Filament\Resources\Acties\ActieResource;
use Filament\Resources\Pages\CreateRecord;

class CreateActie extends CreateRecord
{
    protected static string $resource = ActieResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
