<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Http\Controllers\SettingController;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectInnovationsRelationManager extends RelationManager
{
    protected static string $relationship = 'projectInnovations';

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
                Forms\Components\Hidden::make('project_id')
                    ->default($this->ownerRecord->id),
                Forms\Components\Hidden::make('budget_year_id')
                    ->default($budget_year),
                Forms\Components\Select::make('project_activity_id')
                    ->columnSpanFull()
                    ->options($this->ownerRecord->projectActivities->pluck('name', 'id')),
                Forms\Components\TextInput::make('name')
                    ->columnSpanFull()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Repeater::make('url')
                    ->columnSpanFull()
                    ->reorderable(false)
                    ->schema([
                        Forms\Components\TextInput::make('url')
                            ->required()
                    ]),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('detail')
                    ->required(),
                Forms\Components\Textarea::make('use')
                    ->required(),
                Forms\Components\Textarea::make('problem')
                    ->required(),
                Forms\Components\Textarea::make('suggest')
                    ->required(),
                Forms\Components\FileUpload::make('attachment')
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('projectActivity.name'),
                Tables\Columns\TextColumn::make('type'),
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
