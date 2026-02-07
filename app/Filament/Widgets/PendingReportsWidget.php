<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Reports\ReportResource;
use App\Models\Report;
use App\Models\Status;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class PendingReportsWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Report::query()
                    ->where('status', Status::PENDING->name)
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->url(fn (Report $record): string => ReportResource::getUrl('edit', ['record' => $record]))
                    ->color('primary')
                    ->weight('medium'),
                TextColumn::make('user.name')
                    ->label('Reported By')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('j M Y')
                    ->sortable(),
                TextColumn::make('location_human')
                    ->label('Location')
                    ->limit(30)
                    ->tooltip(fn (Report $record): string => $record->location_human),
                TextColumn::make('organizer_names')
                    ->label('Organizers')
                    ->getStateUsing(function (Report $record) {
                        return $record->organizers->pluck('name')->join(', ');
                    })
                    ->limit(40)
                    ->tooltip(fn (Report $record): string => $record->organizers->pluck('name')->join(', ')),
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('j M Y H:i')
                    ->sortable()
                    ->since()
                    ->tooltip(fn (Report $record): string => $record->created_at->format('j M Y H:i')),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([5, 10, 25])
            ->heading('Pending Reports')
            ->description('Reports waiting for approval')
            ->searchable(false);
    }
}
