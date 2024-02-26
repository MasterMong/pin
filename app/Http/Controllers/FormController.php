<?php

namespace App\Http\Controllers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public static function getProjectActivityFormInput($form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->columnSpanFull()
                ->required()
                ->label('กิจกรรม'),
            DatePicker::make('date_start')
                ->label('จากวันที่')
                ->native(False)
                ->format('Y/m/d')
                ->required()
                ->displayFormat('Y/m/d')
                ->timezone('Asia/Bangkok'),
            DatePicker::make('date_end')
                ->label('ถึงวันที่')
                ->native(False)
                ->format('Y/m/d')
                ->required()
                ->displayFormat('Y/m/d')
                ->timezone('Asia/Bangkok'),
            TextInput::make('expect')
                ->columnSpanFull()
                ->required()
                ->label('ผลที่คาดว่าจะได้รับ'),
            TextInput::make('target_area')
                ->columnSpanFull()
                ->required()
                ->label('กลุ่มเป้าหมาย'),
            // TextInput::make('count_beneficiary')
            // ->label('จำนวนผู้ได้รับผลประโยชน์'),

        ]);
    }
}
