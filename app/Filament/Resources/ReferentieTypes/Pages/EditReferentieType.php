<?php

namespace App\Filament\Resources\ReferentieTypes\Pages;

use App\Filament\Resources\ReferentieTypes\ReferentieTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReferentieType extends EditRecord
{
    protected static string $resource = ReferentieTypeResource::class;

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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remove answers from data as we'll handle them separately
        if (isset($data['dimensions'])) {
            unset($data['dimensions']);
        }
        return $data;
    }

    protected function afterSave(): void
    {
        $data = $this->form->getState();
        
        // Sync dimension scores
        if (isset($data['dimensions']) && is_array($data['dimensions'])) {
            $dimensionScores = [];
            foreach ($data['dimensions'] as $dimensionId => $score) {
                $dimensionScores[$dimensionId] = ['score' => $score];
            }
            $this->record->dimensions()->sync($dimensionScores);
        }
    }
}
