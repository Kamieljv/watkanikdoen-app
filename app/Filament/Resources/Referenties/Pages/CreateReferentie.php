<?php

namespace App\Filament\Resources\Referenties\Pages;

use App\Filament\Resources\Referenties\ReferentieResource;
use App\Traits\HandlesImageUpload;
use Filament\Resources\Pages\CreateRecord;

class CreateReferentie extends CreateRecord
{
    use HandlesImageUpload;

    protected static string $resource = ReferentieResource::class;

    protected function getImageFolderName(): string
    {
        return 'referenties';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
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
