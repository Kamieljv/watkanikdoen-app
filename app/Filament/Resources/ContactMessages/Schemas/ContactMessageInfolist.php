<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use App\Models\ContactMessage;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContactMessageInfolist
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
                    ->label('Name'),

                TextEntry::make('email')
                    ->label('Email address')
                    ->url(fn (ContactMessage $record): string => 'mailto:' . $record->email)
                    ->copyable(),

                TextEntry::make('message')
                    ->label('Message')
                    ->columnSpanFull()
                    ->prose(),
            ]);
    }
}
