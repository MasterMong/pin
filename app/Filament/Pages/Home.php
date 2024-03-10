<?php

namespace App\Filament\Pages;

use App\Tables\Columns\ColumnQ1;
use App\Tables\Columns\ColumnQ2;
use App\Tables\Columns\ColumnQ3;
use App\Tables\Columns\ColumnQ4;
use App\Tables\Columns\ProgressCountActivityColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Home extends Page implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $title = 'ข้อมูลการรายงานกิจกรรม';
    protected static string $view = 'filament.pages.index';

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\Area::query())
            ->columns([
                TextColumn::make('areaType.name')->label('สังกัด'),
                TextColumn::make('name')->label('สพท.'),
                ColumnQ1::make('q1')->label('ไตรมาสที่ 1')->alignCenter(),
                ColumnQ2::make('q2')->label('ไตรมาสที่ 2')->alignCenter(),
                ColumnQ3::make('q3')->label('ไตรมาสที่ 3')->alignCenter(),
                ColumnQ4::make('q4')->label('ไตรมาสที่ 4')->alignCenter()
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

}
