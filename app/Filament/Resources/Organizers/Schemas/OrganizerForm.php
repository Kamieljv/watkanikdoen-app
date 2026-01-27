<?php

namespace App\Filament\Resources\Organizers\Schemas;

use App\Models\Organizer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class OrganizerForm
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
                RichEditor::make('description')
                    ->columnSpanFull(),
                TextInput::make('website')
                    ->url()
                    ->required(),
                FileUpload::make('image_upload')
                    ->disk('public')
                    ->image()
                    ->imageEditor()
                    ->directory('organizers')
                    ->columnSpan(2),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Select::make('themes')
                    ->relationship('themes', 'name')
                    ->multiple()
                    ->preload()
                    ->required(),
                Section::make('SEO & Publishing settings')
                    ->schema([
                        Toggle::make('featured')
                            ->label('Feature this organizer on the homepage')
                            ->default(false),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Organizer::class, 'slug', fn ($record) => $record)
                            ->disabled(fn (?string $operation, ?Organizer $record) => $operation == 'edit' && $record->isPublished()),
                        Select::make('status')
                            ->options([
                                'PENDING' => 'Pending',
                                'APPROVED' => 'Approved',
                                'REJECTED' => 'Rejected',
                                'PUBLISHED' => 'Published',
                            ])
                            ->required(),
                    ])
                    ->columnSpan(2),
            ]);
    }
}
