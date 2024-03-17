<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ActivityResource;
use App\Infolists\Components\RelateEntry;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
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
                        ->label('ชื่อกิจกรรม/ผลงานการขันเคลื่อนนโยบายสู่การปฏิบัติ'),
                    TextEntry::make("code")
                        ->label('รหัสกิจกรรม'),
                    TextEntry::make("duration")
                        ->label('ระยะเวลา (วัน)'),
                    TextEntry::make("date_start")
                        ->label('วันที่เริ่ม'),
                    TextEntry::make("date_end")
                        ->label('วันที่สิ้นสุด'),
                    // ไตรมาสที่
                    TextEntry::make('areaStrategy.detail')->label('กลยุทธ์ สพท.'),
                    TextEntry::make('objective')->label('วัตถุประสงค์'),
                    TextEntry::make('process')->label('การดำเนินงาน'),
                    TextEntry::make('target_area')->label('กลุ่มเป่าหมาย'),
// ผลการดำเนินงาน
                    RepeatableEntry::make('beneficiary')->schema(
                        [
                            Grid::make()->schema(
                                [
                                    TextEntry::make('people')->label('กลุ่มผู้ได้รับประโยชน์'),
                                    TextEntry::make('count')->label('จำนวน/คน')
                                ]
                            )->columns(2)
                        ]
                    )->hiddenLabel(),
                    TextEntry::make('problem')->label('ปัญหา/อุปสรรค'),
                    TextEntry::make('suggestions')
                        ->label('ข้อเสนอแนะ'),
                    IconEntry::make("is_pa_of_manager")->boolean()->label('ประเด็นท้าทาย (PA) ของผู้บริหาร'),
                    IconEntry::make("is_success")
                        ->boolean()
                        ->label('การประเมินตนเอง'),
//                    TextEntry::make("budget"),
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
