<?php

namespace App\Filament\Resources\ReferentieTypes\Pages;

use App\Filament\Resources\ReferentieTypes\ReferentieTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReferentieType extends CreateRecord
{
    protected static string $resource = ReferentieTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove answers from data as we'll handle them separately
        if (isset($data['dimensions'])) {
            unset($data['dimensions']);
        }
        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState();
    
        // Attach dimension scores
        if (isset($data['dimensions']) && is_array($data['dimensions'])) {
            foreach ($data['dimensions'] as $dimensionId => $score) {
                $this->record->dimensions()->attach($dimensionId, ['score' => $score]);
            }
        }
    }
}
