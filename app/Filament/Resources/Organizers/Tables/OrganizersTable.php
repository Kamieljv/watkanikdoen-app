<?php

namespace App\Filament\Resources\Organizers\Tables;

use App\Filament\Actions\ApproveAction;
use App\Filament\Actions\PublishAction;
use App\Models\Status;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class OrganizersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('website')
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->label('Logo')
                    ->circular(),
                IconColumn::make('featured')
                    ->boolean()
                    ->default(false)
                    ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'DRAFT' => 'secondary',
                        'PUBLISHED' => 'success',
                        'PENDING' => 'info',
                        'APPROVED' => 'warning',
                        'REJECTED' => 'danger',
                    })
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
                Filter::make(name: 'published')
                    ->query(fn ($query) => $query->published())
                    ->label('Published')
                    ->toggle(),
                Filter::make(name: 'featured')
                    ->query(fn ($query) => $query->featured())
                    ->label('Featured')
                    ->toggle(),
            ])
            ->recordActions([
                EditAction::make(),
                ApproveAction::make()
                    ->visible(function ($record) {
                        return $record->status === Status::PENDING->name;
                    }),
                PublishAction::make()
                    ->visible(function ($record) {
                        return $record->status === Status::APPROVED->name;
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
