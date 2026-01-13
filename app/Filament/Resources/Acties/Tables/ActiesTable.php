<?php

namespace App\Filament\Resources\Acties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start')
                    ->getStateUsing(fn ($record) => $record->start_date . ' ' . $record->start_time)
                    ->dateTime('j M Y H:i')
                    ->sortable(),
                TextColumn::make('location_human')
                    ->label('Location')
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->label('Image')
                    ->square()
                    ->height(50)
                    ->width(50),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'DRAFT' => 'secondary',
                        'PUBLISHED' => 'success',
                        'PENDING' => 'info',
                    })
                    ->sortable(),
                TextColumn::make('pageviews')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
