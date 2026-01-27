<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                TextInput::make('url')
                    ->url()
                    ->required(),
                ColorPicker::make('color'),
                Select::make('status')
                    ->options(['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive'])
                    ->default('ACTIVE')
                    ->required(),
            ]);
    }
}
