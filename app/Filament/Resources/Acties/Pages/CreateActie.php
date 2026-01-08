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
        // If latitude and longitude are set, create a point geometry
        if (!empty($data['latitude']) && !empty($data['longitude'])) {
            $data['location'] = \DB::raw("ST_GeomFromText('POINT(" . $data['longitude'] . " " . $data['latitude'] . ")')");
        }

        return $data;
    }
}
