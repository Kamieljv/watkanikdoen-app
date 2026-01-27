<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Post;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('title')
                    ->live()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required()
                    ->maxLength(255),
                TextInput::make('seo_title'),
                Textarea::make('excerpt')
                    ->columnSpanFull(),
                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Post::class, 'slug', fn ($record) => $record)
                    ->disabled(fn (?string $operation, ?Post $record) => $operation == 'edit' && $record->isPublished()),
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
                        Toggle::make('featured')
                            ->required(),
                    ])
                    ->columnSpan(2),
            ]);
    }
}
