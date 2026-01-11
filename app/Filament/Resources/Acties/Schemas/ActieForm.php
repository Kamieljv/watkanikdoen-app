<?php

namespace App\Filament\Resources\Acties\Schemas;

use App\Filament\Forms\Components\AddressSearchField;
use App\Models\Actie;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ActieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(255),
                Textarea::make('excerpt')
                    ->columnSpanFull(),
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
                    ->columnSpanFull(),
                FileUpload::make('linked_image')
                    ->image()
                    ->imageEditor()
                    ->columnSpan(2),
                Section::make('Datum en tijd')
                    ->schema([
                        DatePicker::make('start_date'),
                        TimePicker::make('start_time'),
                        DatePicker::make('end_date'),
                        TimePicker::make('end_time'),
                    ])
                    ->columnSpan(1),
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
                    ])
                    ->columnSpan(1),
                Section::make('SEO & Publishing settings')
                    ->schema([
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Actie::class, 'slug', fn ($record) => $record)
                            ->disabled(fn (?string $operation, ?Actie $record) => $operation == 'edit' && $record->isPublished()),
                        Select::make('status')
                            ->options(['PUBLISHED' => 'Published', 'DRAFT' => 'Draft', 'PENDING' => 'Pending'])
                            ->default('DRAFT')
                            ->required(),
                    ])
                    ->columnSpan(2),
            ]);
    }
}
