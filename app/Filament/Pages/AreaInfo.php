<?php

namespace App\Filament\Pages;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;

class AreaInfo extends Page implements HasInfolists
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.area-info';

//    protected static ?string $navigationLabel = auth()->user()->area->name;

    /**
     * @return string|null
     */
    public static function getNavigationLabel(): string
    {
        return auth()->user()->area->name;
    }

    public function getTitle(): string
    {
        return auth()->user()->area->name;
    }

    public function areaInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record(\App\Models\Area::where('id', auth()->user()->area_id)->first())
            ->schema([
                TextEntry::make('name')
            ]);
    }
}
