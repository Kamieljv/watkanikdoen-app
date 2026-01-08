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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If location is set, create a point geometry
        if (!empty($data['location'])) {
            $data['location'] = \DB::raw("ST_GeomFromText('POINT(" . $data['location']['lng'] . " " . $data['location']['lat'] . ")')");
        }

        return $data;
    }
}
