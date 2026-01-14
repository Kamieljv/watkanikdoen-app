<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class AnswersWithDimensionsField extends Field
{
    protected string $view = 'filament.forms.components.answers-with-dimensions-field';
    
    protected array $dimensions = [];
    protected int $minScore = 0;
    protected int $maxScore = 10;

    public function dimensions(array $dimensions): static
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    public function getDimensions(): array
    {
        return $this->dimensions;
    }

    public function minScore(int $score): static
    {
        $this->minScore = $score;
        return $this;
    }

    public function getMinScore(): int
    {
        return $this->minScore;
    }

    public function maxScore(int $score): static
    {
        $this->maxScore = $score;
        return $this;
    }

    public function getMaxScore(): int
    {
        return $this->maxScore;
    }
}
