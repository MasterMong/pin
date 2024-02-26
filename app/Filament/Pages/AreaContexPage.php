<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AreaContexPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.area-contex-page';

    protected static ?string $navigationGroup = 'รายงานแผน/ความก้าวหน้า';

    protected static ?string $navigationLabel = 'สภาพบริบท/แนวทางพัฒนา';

}
