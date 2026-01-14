<?php

namespace App\Filament\Resources\Answers;

use App\Filament\Resources\Answers\Pages\CreateAnswer;
use App\Filament\Resources\Answers\Pages\EditAnswer;
use App\Filament\Resources\Answers\Pages\ListAnswers;
use App\Filament\Resources\Answers\Schemas\AnswerForm;
use App\Filament\Resources\Answers\Tables\AnswersTable;
use App\Models\Answer;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'ActieWijzer';

    protected static ?string $recordTitleAttribute = 'Answer';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return AnswerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnswersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnswers::route('/'),
            'create' => CreateAnswer::route('/create'),
            'edit' => EditAnswer::route('/{record}/edit'),
        ];
    }
}
