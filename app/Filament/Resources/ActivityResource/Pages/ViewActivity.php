<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewActivity extends ViewRecord
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make('ข้อมูลโครงการ')
                ->schema([
                    TextEntry::make("name")
                        ->label('ชื่อโครงการ'),
                    TextEntry::make("code")
                        ->label('รหัสโครงการ'),
                    TextEntry::make("objective"),
                    TextEntry::make("indicator"),
                    TextEntry::make("duration"),
                    TextEntry::make("date_start"),
                    TextEntry::make("date_end"),
                    TextEntry::make("budget"),
                    TextEntry::make("is_pa_of_manager"),
                    TextEntry::make("status"),

                ])->columns(3),
            Section::make('ความสอดคล้อง')
                ->schema([

                ])
                ->grow(False),
        ]);
    }
}
