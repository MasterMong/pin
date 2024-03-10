<?php

namespace App\Filament\Resources\ActivityResource\RelationManagers;

use App\Http\Controllers\SettingController;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityInnovationsRelationManager extends RelationManager
{
    protected static string $relationship = 'ActivityInnovations';

    protected static ?string $modelLabel = 'นวัตกรรม';
    protected static ?string $pluralModelLabel = 'นวัตกรรม';
    protected static ?string $title = 'รายการนวัตกรรม';
    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        $budget_year = SettingController::getSetting('budget_year');
        return $form
            ->schema([
                Forms\Components\Hidden::make('area_id')
                    ->default(auth()->user()->id),
                Forms\Components\Hidden::make('activity_id')
                    ->default($this->ownerRecord->id),
                Forms\Components\Hidden::make('budget_year_id')
                    ->default($budget_year),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('ชื่อนวัตกรรม')
                    ->columnSpanFull()
                    ->maxLength(600),
                Forms\Components\FileUpload::make('attachment')
                    ->maxSize(10000)
                    ->required()
                    ->previewable()
                    ->downloadable()
                    ->maxFiles(3)
                    ->columnSpanFull()
                    ->label('แนบไฟล์')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\TextInput::make('url')
                    ->columnSpanFull()
                    ->label('แนบลิงก์วีดิโอ (ถ้ามี)')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อนวัตกรรม'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([

            ]);
    }
}
