<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ProgressYear extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.progress-year';

    protected static ?string $navigationGroup = 'รายงานแผน/ความก้าวหน้า';

    protected static ?string $navigationLabel = 'ผลการดำเนินงานรอบ 12 เดือน';

    protected static ?int $navigationSort = 5;

    public function getTitle(): string
    {
        return 'ผลการดำเนินงานรอบ 12 เดือน ' . auth()->user()->area->areaType->name . ' ' . auth()->user()->area->name;
    }
}
