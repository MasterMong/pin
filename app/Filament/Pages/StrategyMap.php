<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class StrategyMap extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.strategy-map';

    protected static ?string $navigationGroup = 'รายงานผลการขับเคลื่อนนโยบาย';

    protected static ?string $navigationLabel = 'Strategy Map';

    protected static ?int $navigationSort = 3;

    public function getTitle(): string
    {
        return 'Strategy Map ' . auth()->user()->area->areaType->name . ' ' . auth()->user()->area->name;
    }
}
