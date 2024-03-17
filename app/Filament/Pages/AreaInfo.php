<?php

namespace App\Filament\Pages;

use Filament\Infolists\Components\Section;
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
        return auth()->user()->area->areaType->name . ' ' . auth()->user()->area->name;
    }

    public function getTitle(): string
    {
        return auth()->user()->area->areaType->name . ' ' . auth()->user()->area->name;
    }

    public function areaInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record(\App\Models\Area::where('id', auth()->user()->area_id)->first())
            ->schema([
                Section::make('ข้อมูลทั่วไป')->schema([
                    TextEntry::make('inspectionArea.name')->label('เขตตรวจราชการ'),
                    TextEntry::make('tel')->label('โทรศัทท์'),
                    TextEntry::make('website')->label('เว็บไซต์')->url(true),
//                    TextEntry::make('num_person')->label('จำนวนบุคลากร'),
//                    TextEntry::make('num_school')->label('จำนวนโรงเรียน'),
//                    TextEntry::make('num_teacher')->label('จำนวนครู'),
//                    TextEntry::make('num_student')->label('จำนวนนักเรียน'),
                ])->columns(2),
                Section::make('ที่ตั้ง')->schema([
                    TextEntry::make('address')->label('ที่อยู่'),
                    TextEntry::make('district.name_in_thai')->label('อำเภอ'),
                    TextEntry::make('province.name_in_thai')->label('จังหวัด'),
                    TextEntry::make('zip_code')->label('รหัสไปรษณีย์'),
                ])
            ]);
    }
}
