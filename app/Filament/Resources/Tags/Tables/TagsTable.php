<?php

namespace App\Filament\Resources\Tags\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class TagsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Naam')->searchable()->sortable(),
                TextColumn::make('acties_count')
                    ->label('Acties')
                    ->counts('acties')
                    ->sortable(),
                TextColumn::make('organizers_count')
                    ->label('Organizers')
                    ->counts('organizers')
                    ->sortable(),
                TextColumn::make('referenties_count')
                    ->label('Referenties')
                    ->counts('referenties')
                    ->sortable(),
                TextColumn::make('resources_count')
                    ->label('Books')
                    ->counts('books')
                    ->sortable(),
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
