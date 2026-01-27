<?php

namespace App\Filament\Resources\Acties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
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
            ->defaultSort('start_date', 'desc')
            ->filters([
                Filter::make('published')
                    ->query(fn ($query) => $query->published())
                    ->label('Published')
                    ->toggle(),
                Filter::make('toekomstig')
                    ->query(fn ($query) => $query->nietAfgelopen())
                    ->label('Toekomstige Acties')
                    ->toggle(),
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
