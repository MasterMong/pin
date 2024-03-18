<?php

namespace App\Filament\Pages;

use App\Models\Area;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->record(Area::where('id', auth()->user()->area_id)->first())
                ->modelLabel('ข้อมูล สพท.')
                ->form([
                    TextInput::make('name')
                        ->label('ชื่อ สพท.')
                        ->required()
                        ->maxLength(300),
                    Select::make('inspection_area_id')
                        ->label('เขตตรวจราชการ')
                        ->relationship('inspectionArea', 'name')
                        ->required(),
                    Select::make('area_type_id')
                        ->label('ประเภท')
                        ->relationship('areaType', 'name')
                        ->required(),
                    \Filament\Forms\Components\Section::make()->label('ข้อมูลติดต่อ')->schema([
                        Select::make('district_id')
                            ->label('จังหวัด')
                            ->relationship('district', 'name_in_thai')
                            ->required(),
                        Select::make('province_id')
                            ->label('อำเภอ')
                            ->relationship('province', 'name_in_thai')
                            ->required(),
                        Select::make('region_id')
                            ->label('ภูมิภาค')
                            ->relationship('region', 'name')
                            ->required(),
                        TextInput::make('address')
                            ->label('ที่อยู่')
                            ->maxLength(600),
                        TextInput::make('zip_code')
                            ->label('รหัสไปรษณีย์')
                            ->maxLength(5),
                        TextInput::make('tel')
                            ->label('โทรศัพท์')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                    ])->columns(2),
                    TextInput::make('num_person')
                        ->label('จำนวนบุคลากร')
                        ->required()
                        ->numeric()
                        ->default(0),
                    TextInput::make('num_school')
                        ->label('จำนวนโรงเรียน')
                        ->required()
                        ->numeric()
                        ->default(0),
                    TextInput::make('num_teacher')
                        ->label('จำนวนครู')
                        ->required()
                        ->numeric()
                        ->default(0),
                    TextInput::make('num_student')
                        ->label('จำนวนนักเรียน')
                        ->required()
                        ->numeric()
                        ->default(0),
                    TextInput::make('website')
                        ->label('เว็บไซต์')
                        ->required()
                        ->maxLength(600),
                    TextInput::make('latitude')
                        ->required()
                        ->maxLength(30),
                    TextInput::make('longitude')
                        ->required()
                        ->maxLength(30)
                ])
                ->slideOver()
        ];
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
