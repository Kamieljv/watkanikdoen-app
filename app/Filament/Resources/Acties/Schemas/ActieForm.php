<?php

namespace App\Filament\Resources\Acties\Schemas;

use App\Filament\Forms\Components\AddressSearchField;
use App\Models\Actie;
use App\Models\User;
use Carbon\Carbon;
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
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))                    ->required()
                    ->required()
                    ->maxLength(255),
                Textarea::make('excerpt')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                Select::make('organizer_id')
                    ->relationship('organizers', 'name')
                    ->multiple()
                    ->preload()
                    ->required(),
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
                    ->directory('acties')
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
                    ])
                    ->columnSpan(1),
                Section::make('Thema en categorie')
                    ->schema([
                        Select::make('themes')
                            ->relationship('themes', 'name')
                            ->multiple()
                            ->preload()
                            ->required(),
                        Select::make('categories')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload()
                            ->required(),
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
                    ->columnSpan(2),
                Section::make('SEO & Publishing settings')
                    ->schema([
                        Select::make('user_id')
                            ->label('Author')
                            ->relationship('user', 'name')
                            ->default(fn () => User::first()?->id)
                            ->preload()
                            ->required(),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Actie::class, 'slug', fn ($record) => $record)
                            ->disabled(fn (?string $operation, ?Actie $record) => $operation == 'edit' && $record->isPublished()),
                        TextInput::make('keywords')
                            ->helperText('Comma separated keywords for SEO')
                            ->required()
                            ->maxLength(1000),
                        Select::make('status')
                            ->options(['PUBLISHED' => 'Published', 'DRAFT' => 'Draft', 'PENDING' => 'Pending'])
                            ->default('DRAFT')
                            ->required(),
                    ])
                    ->columnSpan(2),
            ]);
    }
}
