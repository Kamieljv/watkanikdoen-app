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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If location is set, create a point geometry
        if (!empty($data['location'])) {
            $data['location'] = \DB::raw("ST_GeomFromText('POINT(" . $data['location']['lng'] . " " . $data['location']['lat'] . ")')");
        }

        return $data;
    }
}
