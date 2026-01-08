<?php

namespace App\Filament\Resources\Acties\Pages;

use App\Filament\Resources\Acties\ActieResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditActie extends EditRecord
{
    protected static string $resource = ActieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
