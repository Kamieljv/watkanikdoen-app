<?php

namespace App\Filament\Resources\Organizers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrganizerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->live()
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('website')
                    ->url()
                    ->required(),
                TextInput::make('logo'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('featured')
                    ->numeric(),
                TextInput::make('user_id')
                    ->numeric(),
                Select::make('status')
                    ->options([
                        'PENDING' => 'Pending',
                        'APPROVED' => 'Approved',
                        'REJECTED' => 'Rejected',
                        'PUBLISHED' => 'Published',
                    ])
                    ->default('PENDING')
                    ->required(),
            ]);
    }
}
