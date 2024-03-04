<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Realtime extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.realtime';
    protected static ?string $navigationGroup = 'รายงานแผน/ความก้าวหน้า';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'รายงานความก้าวหน้าแบบ Realtime';

    public function getTitle(): string
    {
        return 'รายงานความก้าวหน้าแบบ Realtime ' . auth()->user()->area->areaType->name . ' ' . auth()->user()->area->name;
    }
}
