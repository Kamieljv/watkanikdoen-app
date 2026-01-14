<?php

namespace App\Filament\Resources\Questions\Schemas;

use App\Filament\Forms\Components\AnswersWithDimensionsField;
use App\Models\Dimension;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('subject')
                    ->helperText('If the subject is "Thema", the question will not have answers but have a theme picker.')
                    ->required(),
                Select::make('status')
                    ->options(['INACTIVE' => 'Inactive', 'ACTIVE' => 'Active'])
                    ->default('ACTIVE')
                    ->required(),
                AnswersWithDimensionsField::make('answers')
                    ->label('Answers')
                    ->dimensions(Dimension::all()->map(fn($d) => [
                        'id' => $d->id,
                        'name' => $d->name,
                    ])->toArray())
                    ->minScore(0)
                    ->maxScore(10)
                    ->columnSpanFull()
                    ->hidden(fn (Get $get): bool => $get('subject') === 'Thema'),
            ]);
    }
}
