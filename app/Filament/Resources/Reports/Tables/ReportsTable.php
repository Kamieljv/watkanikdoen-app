<?php

namespace App\Filament\Resources\Reports\Tables;

use App\Filament\Actions\ApproveAction;
use App\Filament\Actions\PublishAction;
use App\Filament\Resources\Organizers\OrganizerResource;
use App\Models\Status;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
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
                    ->getStateUsing(function ($record) {
                        return $record->organizers->map(function ($organizer) {
                            $url = OrganizerResource::getUrl('edit', ['record' => $organizer]);
                            return "<a href=\"{$url}\" class=\"text-primary-600 hover:underline\">{$organizer->name}</a>";
                        })->join(', ');
                    })
                    ->html()
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
                    ->query(fn ($query) => $query->where('status', Status::PENDING->name))
                    ->label('Pending Reports'),
            ])
            ->recordActions([
                ApproveAction::make()
                    ->visible(function ($record) {
                        return $record->status === Status::PENDING->name;
                    }),
                PublishAction::make()
                    ->visible(function ($record) {
                        return $record->status === Status::APPROVED->name;
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
