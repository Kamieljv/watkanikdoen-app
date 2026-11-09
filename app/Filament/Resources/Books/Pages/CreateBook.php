<?php

namespace App\Filament\Resources\Books\Pages;

use App\Filament\Resources\Books\BookResource;
use App\Traits\HandlesImageUpload;
use Filament\Resources\Pages\CreateRecord;

class CreateBook extends CreateRecord
{
    use HandlesImageUpload;

    protected static string $resource = BookResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getImageFolderName(): string
    {
        return 'books';
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
