<?php

namespace App\Filament\Resources\Reports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class ReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('start')
                    ->getStateUsing(fn ($record) => $record->start_date . ' ' . $record->start_time)
                    ->dateTime('j M Y H:i')
                    ->sortable(),
                TextColumn::make('organizer_names')
                    ->getStateUsing(fn ($record) => $record->organizers->pluck('name')->join(', '))
                    ->label('Organizers')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                ImageColumn::make('image_url')
                    ->label('Image')
                    ->square()
                    ->height(50)
                    ->width(50),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'PENDING' => 'info',
                        'APPROVED' => 'success',
                        'REJECTED' => 'danger',
                    })
                    ->sortable(),
                BooleanColumn::make('reporter_notified')
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
                Filter::make('pending')
                    ->query(fn ($query) => $query->where('status', 'PENDING'))
                    ->label('Pending Reports'),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
