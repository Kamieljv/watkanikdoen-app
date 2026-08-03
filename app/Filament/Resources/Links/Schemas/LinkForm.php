<?php

namespace App\Filament\Resources\Links\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->maxLength(255),
                TextInput::make('url')
                    ->url()
                    ->required()
                    ->maxLength(255),
                FileUpload::make('thumbnail')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('links'),
                Select::make('status')
                    ->options(['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive'])
                    ->default('ACTIVE')
                    ->required(),
            ]);
    }
}
