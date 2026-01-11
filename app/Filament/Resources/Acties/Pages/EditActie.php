<?php

namespace App\Filament\Resources\Acties\Pages;

use App\Filament\Resources\Acties\ActieResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use MatanYadaev\EloquentSpatial\Objects\Point;

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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // The location Point object will be automatically converted to array by afterStateHydrated
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If location coordinates are set, create a Point object
        if (!empty($data['location']) && is_array($data['location'])) {
            $data['location'] = new Point(
                latitude: $data['location']['lat'],
                longitude: $data['location']['lng']
            );
        }

        return $data;
    }
}
