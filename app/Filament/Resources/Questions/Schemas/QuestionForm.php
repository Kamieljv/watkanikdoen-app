<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                    ->required(),
                Select::make('status')
                    ->options(['INACTIVE' => 'Inactive', 'ACTIVE' => 'Active'])
                    ->default('ACTIVE')
                    ->required(),
            ]);
    }
}
