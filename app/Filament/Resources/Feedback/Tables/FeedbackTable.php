<?php

namespace App\Filament\Resources\Feedback\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FeedbackTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Name')
                    ->placeholder('Anonymous')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->placeholder('No subject')
                    ->searchable(),

                TextColumn::make('message')
                    ->label('Message')
                    ->limit(60)
                    ->wrap(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}