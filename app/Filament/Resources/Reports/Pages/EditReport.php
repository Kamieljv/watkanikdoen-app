<?php

namespace App\Filament\Resources\Reports\Pages;

use App\Filament\Resources\Reports\ReportResource;
use App\Traits\HandlesImageUpload;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use MatanYadaev\EloquentSpatial\Objects\Point;

class EditReport extends EditRecord
{
    use HandlesImageUpload;

    protected static string $resource = ReportResource::class;

    protected function getImageFolderName(): string
    {
        return 'reports';
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

            if (empty($data['location'])) {
                $data['no_specific_location'] = true;
            }
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If no specified location is toggled, set location fields to null
         if ($data['no_specific_location']) {
            $data['location'] = null;
        }

        // If location coordinates are set, create a Point object
        if (!empty($data['location']) && is_array($data['location'])) {
            $data['location'] = new Point(
                latitude: $data['location']['lat'],
                longitude: $data['location']['lng']
            );
        }

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
