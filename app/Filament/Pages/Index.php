<?php

namespace App\Filament\Pages;

use App\Tables\Columns\ProgressCountActivityColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Index extends Page implements HasTable, HasForms
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
                TextColumn::make('name'),
                ProgressCountActivityColumn::make('activity')
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
