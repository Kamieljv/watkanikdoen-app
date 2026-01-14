<?php

namespace App\Filament\Resources\Themes\Schemas;

use App\Models\Theme;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class ThemeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->unique(Theme::class, 'slug', fn ($record) => $record)
                    ->required(),
                ColorPicker::make('color'),
            ]);
    }
}
