<?php

namespace App\Filament\Resources\ReferentieTypes\Schemas;

use App\Models\Dimension;
use App\Models\ReferentieType;
use App\Filament\Forms\Components\DimensionsField;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ReferentieTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ReferentieType::class, 'slug', fn ($record) => $record),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['PUBLISHED' => 'Published', 'DRAFT' => 'Draft'])
                    ->default('DRAFT')
                    ->required(),
                DimensionsField::make('dimensions')
                    ->label('Dimensions')
                    ->dimensions(Dimension::all()->map(fn($d) => [
                        'id' => $d->id,
                        'name' => $d->name,
                    ])->toArray())
                    ->minScore(0)
                    ->maxScore(10)
                    ->columnSpanFull()
            ]);
    }
}
