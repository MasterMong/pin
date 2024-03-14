<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ActivityResource;
use App\Infolists\Components\RelateEntry;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\View;
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

            Section::make('ข้อมูลกิจกรรม')
                ->schema([
                    TextEntry::make("name")
                        ->label('ชื่อผลงานการขันเคลื่อนนโยบายสู่การปฏิบัติ'),
                    TextEntry::make("code")
                        ->label('รหัสกิจกรรม'),
                    TextEntry::make("duration")
                        ->label('ระยะเวลา (วัน)'),
                    TextEntry::make("date_start")
                        ->label('วันที่เริ่ม'),
                    TextEntry::make("date_end")
                        ->label('วันที่สิ้นสุด'),
//                    TextEntry::make("budget"),
//                    TextEntry::make("is_pa_of_manager"),
//                    TextEntry::make("status"),

                ])->columns(3),
            Section::make('ความสอดคล้อง')
                ->schema([
                    RelateEntry::make('relate_items')->hiddenLabel()
                ])
                ->grow(False),
            Section::make('ภาพกิจกรรม')->schema([
                ImageEntry::make('galleries')->hiddenLabel()->columnSpanFull()->openUrlInNewTab()
            ])
        ]);
    }
}
