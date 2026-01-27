<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Models\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->required(),
                TextInput::make('title')
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(255),
                Textarea::make('excerpt')
                    ->columnSpanFull(),
                RichEditor::make('body')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Page::class, 'slug', fn ($record) => $record)
                    ->disabled(fn (?string $operation, ?Page $record) => $operation == 'edit' && $record->isPublished()),
                Section::make('SEO & Publishing settings')
                    ->schema([
                        Textarea::make('meta_description')
                            ->columnSpanFull(),
                        Textarea::make('meta_keywords')
                            ->columnSpanFull(),
                        Select::make('status')
                            ->options(['PUBLISHED' => 'Published', 'DRAFT' => 'Draft'])
                            ->default('DRAFT')
                            ->required(),
                    ])
                    ->columnSpan(2),
            ]);
    }
}
