<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Progress extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.progress';

    protected static ?string $navigationLabel = 'การส่งแผน ฯ ของ สพท.';
    public function getTitle(): string
    {
        return 'การส่งแผนดำเนินงานของ สพท.';
    }
}
