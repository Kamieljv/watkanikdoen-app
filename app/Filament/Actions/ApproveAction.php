<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class ApproveAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'approve';
    }

    public function getIcon(string|\BackedEnum|\Illuminate\Contracts\Support\Htmlable|null $default = null): string|\BackedEnum|\Illuminate\Contracts\Support\Htmlable|null
    {
        return Heroicon::OutlinedCheckCircle;
    }

    public function getColor(): array|string|null
    {
        return 'success';
    }

    public static function make($name = 'approve'): static
    {
        return parent::make($name)
            ->url(fn ($record) => $record->getApproveUrl())
            ->label('Approve');
    }
}