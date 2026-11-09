<?php

namespace App\Filament\Resources\Questions\Pages;

use App\Filament\Resources\Questions\QuestionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove answers from data as we'll handle them separately
        if (isset($data['answers'])) {
            unset($data['answers']);
        }
        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState();
        
        // Create answers and attach dimension scores
        if (isset($data['answers']) && is_array($data['answers'])) {
            foreach ($data['answers'] as $answerData) {
                $answer = $this->record->answers()->create([
                    'answer' => $answerData['answer'],
                ]);

                // Attach dimension scores
                if (isset($answerData['dimensions']) && is_array($answerData['dimensions'])) {
                    foreach ($answerData['dimensions'] as $dimensionId => $score) {
                        $answer->dimensions()->attach($dimensionId, ['score' => $score]);
                    }
                }
            }
        }
    }
}
