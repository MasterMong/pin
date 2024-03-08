<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\RelationManagers\ProjectActivityRelationManager;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'รายงานผลการขับเคลื่อนนโยบาย';

    protected static ?string $navigationLabel = 'ผลการขับเคลื่อนนโยบาย';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('area_id')
                    ->relationship('area', 'name')
                    ->required(),
                Forms\Components\Select::make('budget_year_id')
                    ->relationship('budgetYear', 'name')
                    ->required(),
                Forms\Components\Select::make('area_strategy_id')
                    ->relationship('areaStrategy', 'id')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('ชื่อกิจกรรม')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('code')
                    ->label('รหัส')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('objective')
                    ->required()
                    ->maxLength(1000),
                Forms\Components\Textarea::make('indicator')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('duration')
                    ->maxLength(100),
                Forms\Components\TextInput::make('date_start')
                    ->maxLength(50),
                Forms\Components\TextInput::make('date_end')
                    ->maxLength(50),
                Forms\Components\TextInput::make('budget')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_pa_of_manager')
                    ->required(),
                Forms\Components\Textarea::make('problem')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('suggestions')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('progress')
                    ->numeric(),
                Forms\Components\Textarea::make('relate_items')
                    ->required(),
                Forms\Components\TextInput::make('handler_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('รหัส')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อกิจกรรม')
                    ->searchable(),
//                Tables\Columns\TextColumn::make('date_start')
//                    ->label('เริ่ม')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('date_end')
//                    ->label('สิ้นสุด')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('budget')
//                    ->label('งบประมาณ')
//                    ->numeric()
//                    ->label('งบ')
//                    ->sortable(),
//                Tables\Columns\ToggleColumn::make('is_pa_of_manager')
//                    ->label('PA')
//                    ,
                Tables\Columns\TextColumn::make('progress')
                    ->label('ความคืบหน้า')
                    ->numeric()
                    ->sortable(),
//                Tables\Columns\TextColumn::make('handler_name')
//                    ->label('ผุ้รับผิดชอบ')
//                    ->hidden()
//                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('สถานะ')
                    ->searchable(),
//                Tables\Columns\TextColumn::make('created_at')
//                    ->dateTime()
//                    ->sortable()
//                    ->toggleable(isToggledHiddenByDefault: true),
//                Tables\Columns\TextColumn::make('updated_at')
//                    ->dateTime()
//                    ->sortable()
//                    ->toggleable(isToggledHiddenByDefault: true),
//                Tables\Columns\TextColumn::make('deleted_at')
//                    ->dateTime()
//                    ->sortable()
//                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ActivityInnovationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewActivity::route('/{record}'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
