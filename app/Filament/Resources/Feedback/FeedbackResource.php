<?php

namespace App\Filament\Resources\Feedback;

use App\Filament\Resources\Feedback\Pages\CreateFeedback;
use App\Filament\Resources\Feedback\Pages\EditFeedback;
use App\Filament\Resources\Feedback\Pages\ListFeedback;
use App\Filament\Resources\Feedback\Pages\ViewFeedback;
use App\Filament\Resources\Feedback\Schemas\FeedbackForm;
use App\Filament\Resources\Feedback\Schemas\FeedbackInfolist;
use App\Filament\Resources\Feedback\Tables\FeedbackTable;
use App\Models\Feedback;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $navigationLabel = 'Feedback';

    protected static UnitEnum|string|null $navigationGroup = 'Website';

    protected static ?int $navigationSort = 99;

    protected static ?string $recordTitleAttribute = 'subject';

    public static function infolist(Schema $schema): Schema
    {
        return FeedbackInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeedbackTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFeedback::route('/'),
            'view' => ViewFeedback::route('/{record}'),
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return FeedbackForm::configure($schema);
    }
}
