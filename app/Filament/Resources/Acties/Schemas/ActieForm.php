<?php

namespace App\Filament\Resources\Acties\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ActieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('excerpt')
                    ->columnSpanFull(),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('keywords')
                    ->columnSpanFull(),
                Textarea::make('externe_link')
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('start_date'),
                TimePicker::make('start_time'),
                DatePicker::make('end_date'),
                TimePicker::make('end_time'),
                TextInput::make('location'),
                TextInput::make('location_human'),
                FileUpload::make('image')
                    ->image(),
                Toggle::make('disobedient'),
                TextInput::make('slug')
                    ->required(),
                Select::make('status')
                    ->options(['PUBLISHED' => 'P u b l i s h e d', 'DRAFT' => 'D r a f t', 'PENDING' => 'P e n d i n g'])
                    ->default('DRAFT')
                    ->required(),
                TextInput::make('pageviews')
                    ->numeric(),
            ]);
    }
}
