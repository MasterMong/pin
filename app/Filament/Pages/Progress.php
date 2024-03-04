<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Progress extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.progress';

    public function getTitle(): string
    {
        return 'Strategy Map ' . auth()->user()->area->areaType->name . ' ' . auth()->user()->area->name;
    }
}
