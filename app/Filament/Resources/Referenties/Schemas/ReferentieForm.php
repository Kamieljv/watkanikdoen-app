<?php

namespace App\Filament\Resources\Referenties\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ReferentieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('url')
                    ->url()
                    ->required(),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_upload')
                    ->disk('public')
                    ->image()
                    ->imageEditor()
                    ->directory('referenties')
                    ->columnSpan(2),
                Select::make('referentie_type_id')
                    ->label('Referentietypes')
                    ->relationship('referentie_types', 'title')
                    ->multiple()
                    ->preload()
                    ->required(),
                Select::make('themes')
                    ->relationship('themes', 'name')
                    ->multiple()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->options(['PUBLISHED' => 'Published', 'DRAFT' => 'Draft'])
                    ->default('DRAFT')
                    ->required(),
            ]);
    }
}
