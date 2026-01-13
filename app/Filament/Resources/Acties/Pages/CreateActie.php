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

        // Handle image separately - don't save it to the image column
        if (isset($data['image_upload'])) {
            unset($data['image_upload']);
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState();
        
        if (isset($data['image_upload']) && is_array($data['image_upload']) && !empty($data['image_upload'])) {
            foreach ($data['image_upload'] as $filePath) {
                $fileSystemItem = \MWGuerra\FileManager\Models\FileSystemItem::firstOrCreate([
                    'storage_path' => $filePath,
                ], [
                    'name' => basename($filePath),
                    'type' => 'file',
                    'file_type' => 'image',
                    'storage_path' => $filePath,
                ]);
                
                $this->record->image()->attach($fileSystemItem->id);
            }
        }
    }
}
