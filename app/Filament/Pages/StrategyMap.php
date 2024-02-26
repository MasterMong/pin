<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class StrategyMap extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.strategy-map';

    protected static ?string $navigationGroup = 'รายงานแผน/ความก้าวหน้า';

    protected static ?string $navigationLabel = 'Strategy Map';
}
