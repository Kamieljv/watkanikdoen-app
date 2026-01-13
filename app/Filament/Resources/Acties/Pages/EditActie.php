<?php

namespace App\Filament\Resources\Acties\Pages;

use App\Filament\Resources\Acties\ActieResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use MatanYadaev\EloquentSpatial\Objects\Point;
use \MWGuerra\FileManager\Models\FileSystemItem;

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
        \Log::debug('After save data: ' . json_encode($data));

        // If image upload data is present and is different, update the relationship        
        if (isset($data['image_upload']) && $this->record->image()->first()?->storage_path !== $data['image_upload']) {
            \Log::debug('Updating image uploads for record ID: ' . $this->record->id);
            // Remove old images
            $this->record->image()->detach();

            // Get the id of the folder FileSystemItem for 'acties' if it exists
            $folderId = FileSystemItem::where('name', 'acties')
                ->where('type', 'folder')
                ->first()->id ?? null;

            // Get 
            
            // Attach new images
            $fileSystemItem = FileSystemItem::firstOrCreate([
                'storage_path' => $data['image_upload'],
            ], [
                'parent_id' => $folderId,
                'name' => basename($data['image_upload']),
                'type' => 'file',
                'file_type' => 'image',
                'size' => filesize(storage_path('app/public/' . $data['image_upload'])),
                'storage_path' => $data['image_upload'],
            ]);
            
            $this->record->image()->attach($fileSystemItem->id);
        }
    }
}
