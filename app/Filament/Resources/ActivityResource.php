<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages\CreateActivity;
use App\Filament\Resources\ActivityResource\Pages\EditActivity;
use App\Filament\Resources\ActivityResource\Pages\ListActivities;
use App\Filament\Resources\ActivityResource\RelationManagers\ActivityInnovationsRelationManager;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\RelationManagers\ProjectActivityRelationManager;
use App\Models\Activity;
use App\Tables\Columns\ColumnInnovationList;
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

    protected static ?string $navigationLabel = 'รายงานความก้าวหน้า';

    protected static ?string $modelLabel = 'กิจกรรม';
    protected static ?string $pluralModelLabel = 'กิจกรรม';
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
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('duration')
                    ->maxLength(100),
                Forms\Components\TextInput::make('date_start')
                    ->maxLength(50),
                Forms\Components\TextInput::make('date_end')
                    ->maxLength(50),
                Forms\Components\TextInput::make('q1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('q2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('q3')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('q4')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('process')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('target_area')
                    ->required()
                    ->maxLength(1000),
                Forms\Components\TextInput::make('relate_items')
                    ->required(),
                Forms\Components\Toggle::make('is_pa_of_manager')
                    ->required(),
                Forms\Components\TextInput::make('beneficiary')
                    ->required(),
                Forms\Components\Textarea::make('problem')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('suggestions')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_success'),
                Forms\Components\TextInput::make('progress')
                    ->numeric(),
                Forms\Components\TextInput::make('handler_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(50)
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('code')
//                    ->label('รหัส')
//                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อกิจกรรม')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_success')
                    ->alignCenter()
                    ->label('เป็นไปตามแผน'),
                ColumnInnovationList::make('activityInnovations')
                    ->label('นวัตกรรม'),
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
            ActivityInnovationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivities::route('/'),
            'create' => CreateActivity::route('/create'),
            'view' => Pages\ViewActivity::route('/{record}'),
            'edit' => EditActivity::route('/{record}/edit'),
        ];
    }
}
