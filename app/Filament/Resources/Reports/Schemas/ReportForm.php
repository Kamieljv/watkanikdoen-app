<?php

namespace App\Filament\Resources\Reports\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
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
                TextInput::make('externe_link')
                    ->required()
                    ->url()
                    ->columnSpanFull(),
                DatePicker::make('start_date'),
                TimePicker::make('start_time'),
                DatePicker::make('end_date'),
                TimePicker::make('end_time'),
                TextInput::make('location'),
                TextInput::make('location_human')
                    ->required(),
                FileUpload::make('image')
                    ->image(),
                Select::make('status')
                    ->options(['PENDING' => 'Pending', 'APPROVED' => 'Approved', 'REJECTED' => 'Rejected'])
                    ->default('PENDING')
                    ->required(),
            ]);
    }
}
