<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Acties\ActieResource;
use App\Filament\Resources\Organizers\OrganizerResource;
use Filament\Widgets\Widget;

class QuickActions extends Widget
{
    protected string $view = 'filament.widgets.quick-actions';

    public string $header = 'Snelle acties';
    
    public function getActions(): array
    {
        return [
            [
                'label' => 'Nieuwe Actie aanmaken',
                'icon' => 'heroicon-o-megaphone',
                'url' => ActieResource::getUrl('create'),
                'color' => 'primary',
            ],
            [
                'label' => 'Nieuwe Organizer aanmaken',
                'icon' => 'heroicon-o-users',
                'url' => OrganizerResource::getUrl('create'),
                'color' => 'primary',
            ],
        ];
    }
}
