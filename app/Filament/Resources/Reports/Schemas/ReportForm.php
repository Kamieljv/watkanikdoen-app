<?php

namespace App\Filament\Resources\Reports\Schemas;

use App\Filament\Forms\Components\AddressSearchField;
use Carbon\Carbon;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Reporter')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('organizer_ids')
                    ->label('Organizers')
                    ->options(function (): array {
                        $organizers = \App\Models\Organizer::all();
                        $options = [];
                        foreach ($organizers as $organizer) {
                            $options[$organizer->id] = $organizer->name;
                        }
                        return $options;
                    })
                    ->multiple()
                    ->required(),
                TextInput::make('title')
                    ->required(),
                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                TagsInput::make('externe_link')
                    ->label('External link')
                    ->separator(',')
                    ->required()
                    ->nestedRecursiveRules([
                        'min:3',
                        'max:255',
                        'url',
                    ])
                    ->columnSpan(1),
                FileUpload::make('image_upload')
                    ->disk('public')
                    ->image()
                    ->imageEditor()
                    ->directory('reports')
                    ->columnSpan(2),
                Section::make('Datum en tijd')
                    ->schema([
                        DatePicker::make('start_date')
                            ->live()
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('end_date', $state))
                            ->required(),
                        TimePicker::make('start_time')
                            ->seconds(false)
                            ->live()
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('end_time', Carbon::parse($state)->addHours(1)->format('H:i')))
                            ->format('H:i'),
                        DatePicker::make('end_date')
                            ->required()
                            ->afterOrEqual('start_date'),
                        TimePicker::make('end_time')
                            ->seconds(false)
                            ->format('H:i'),
                    ]),
                Section::make('Locatie')
                    ->schema([
                        Toggle::make('no_specific_location')
                                    ->label('This action has no specific location')
                                    ->reactive()
                                    ->afterStateUpdated(function (Set $set, ?bool $state): void {
                                        if ($state) {
                                            $set('location', null);
                                            $set('address_search', null);
                                        }
                                    }),
                        AddressSearchField::make('address_search')
                            ->label('Search address')
                            ->placeholder('Type an address to search...')
                            ->helperText('Search for an address to automatically set coordinates')
                            ->hidden(fn ($get) => $get('no_specific_location')),
                        Map::make('location')
                            ->label('Coördinaten')
                            ->defaultLocation(latitude: 52.373165, longitude: 4.895716)
                            ->reactive()
                            ->afterStateHydrated(function ($state, $record, $set): void {
                                if ($record?->location) {
                                    $set('location', ['lat' => $record->location->latitude, 'lng' => $record->location->longitude]);
                                }
                            })
                            ->hidden(fn ($get) => $get('no_specific_location')),
                        TextInput::make('location_human')
                            ->label('Location')
                            ->required()
                            ->maxLength(255),
                    ])->columnSpan(1),
                Section::make('Status')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'PENDING' => 'Pending',
                                'APPROVED' => 'Approved',
                                'REJECTED' => 'Rejected',
                            ])
                            ->required(),
                    ])->columnSpan(1),
            ]);
    }
}
