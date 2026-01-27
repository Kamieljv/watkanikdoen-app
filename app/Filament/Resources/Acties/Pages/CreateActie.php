<?php

namespace App\Filament\Resources\Acties\Pages;

use App\Filament\Resources\Acties\ActieResource;
use App\Traits\HandlesImageUpload;
use Filament\Resources\Pages\CreateRecord;

class CreateActie extends CreateRecord
{
    use HandlesImageUpload;

    protected static string $resource = ActieResource::class;

    protected function getImageFolderName(): string
    {
        return 'acties';
    }

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

        // Handle image separately - don't save it to the image column
        if (isset($data['image_upload'])) {
            unset($data['image_upload']);
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState();
        
        // If image upload data is present add an image and attach it       
        if (isset($data['image_upload'])) {
            $this->attachImage($data['image_upload']);
        }
    }
}
