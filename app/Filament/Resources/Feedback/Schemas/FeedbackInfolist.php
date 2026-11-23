<?php

namespace App\Filament\Resources\Feedback\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FeedbackInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('subject')
                    ->label('Subject')
                    ->placeholder('No subject'),

                TextEntry::make('created_at')
                    ->label('Received')
                    ->dateTime('d F Y, H:i'),

                TextEntry::make('name')
                    ->label('Name')
                    ->placeholder('Anonymous'),

                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('Not provided'),

                TextEntry::make('message')
                    ->label('Message')
                    ->columnSpanFull()
                    ->prose(),
            ]);
    }
}