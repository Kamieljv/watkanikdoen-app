<?php

namespace App\Filament\Resources\Questions\Pages;

use App\Filament\Resources\Questions\QuestionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQuestion extends EditRecord
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load answers with dimension scores
        if ($this->record) {
            $data['answers'] = $this->record->answers->map(function ($answer) {
                $dimensions = [];
                foreach ($answer->dimensions as $dimension) {
                    $dimensions[$dimension->id] = $dimension->pivot->score;
                }
                return [
                    'id' => $answer->id,
                    'answer' => $answer->answer,
                    'dimensions' => $dimensions,
                ];
            })->toArray();
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remove answers from data as we'll handle them separately
        if (isset($data['answers'])) {
            unset($data['answers']);
        }
        return $data;
    }

    protected function afterSave(): void
    {
        $data = $this->form->getState();
        
        // Get existing answer IDs
        $existingAnswerIds = $this->record->answers->pluck('id')->toArray();
        $updatedAnswerIds = [];

        // Update or create answers
        if (isset($data['answers']) && is_array($data['answers'])) {
            foreach ($data['answers'] as $answerData) {
                if (isset($answerData['id']) && $answerData['id']) {
                    // Update existing answer
                    $answer = $this->record->answers()->find($answerData['id']);
                    if ($answer) {
                        $answer->update(['answer' => $answerData['answer']]);
                        $updatedAnswerIds[] = $answer->id;
                    }
                } else {
                    // Create new answer
                    $answer = $this->record->answers()->create([
                        'answer' => $answerData['answer'],
                    ]);
                    $updatedAnswerIds[] = $answer->id;
                }

                // Sync dimension scores
                if (isset($answerData['dimensions']) && is_array($answerData['dimensions'])) {
                    $dimensionScores = [];
                    foreach ($answerData['dimensions'] as $dimensionId => $score) {
                        $dimensionScores[$dimensionId] = ['score' => $score];
                    }
                    $answer->dimensions()->sync($dimensionScores);
                }
            }
        }

        // Delete answers that were removed
        $answersToDelete = array_diff($existingAnswerIds, $updatedAnswerIds);
        if (!empty($answersToDelete)) {
            $this->record->answers()->whereIn('id', $answersToDelete)->delete();
        }
    }
}
