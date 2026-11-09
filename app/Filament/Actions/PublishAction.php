<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;


class PublishAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'publish';
    }

    public function getIcon(string|\BackedEnum|\Illuminate\Contracts\Support\Htmlable|null $default = null): string|\BackedEnum|\Illuminate\Contracts\Support\Htmlable|null
    {
        return Heroicon::OutlinedArrowUp;
;
    }

    public function getColor(): array|string|null
    {
        return 'info';
    }

    public static function make($name = 'publish'): static
    {
        return parent::make($name)
            ->action(fn ($record) => $record->publish())
            ->label('Publish');
    }
}