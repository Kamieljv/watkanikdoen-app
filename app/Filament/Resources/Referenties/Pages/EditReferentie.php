<?php

namespace App\Filament\Resources\Referenties\Pages;

use App\Filament\Resources\Referenties\ReferentieResource;
use App\Traits\HandlesImageUpload;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReferentie extends EditRecord
{
    use HandlesImageUpload;

    protected static string $resource = ReferentieResource::class;

    protected function getImageFolderName(): string
    {
        return 'referenties';
    }
    
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
        // Load image from relationship
        if ($this->record) {
            $image = $this->record->image()->where('file_type', 'image')->first();
            if ($image && $image->storage_path) {
                $data['image_upload'] = [$image->storage_path];
            }
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remove image from the model when it is not set in the form data
        if (!isset($data['image_upload'])) {
            $this->record->image()->detach();
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $data = $this->form->getState();
        // If image upload data is present and is different, update the relationship        
        if (isset($data['image_upload']) && $this->hasImageChanged($data['image_upload'])) {
            $this->updateImage($data['image_upload']);
        }
    }
}
