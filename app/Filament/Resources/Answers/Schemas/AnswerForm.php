<?php

namespace App\Filament\Resources\Answers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnswerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('answer')
                    ->required(),
                TextInput::make('question_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
