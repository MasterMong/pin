<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages\CreateActivity;
use App\Filament\Resources\ActivityResource\Pages\EditActivity;
use App\Filament\Resources\ActivityResource\Pages\ListActivities;
use App\Filament\Resources\ActivityResource\RelationManagers\ActivityInnovationsRelationManager;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\RelationManagers\ProjectActivityRelationManager;
use App\Http\Controllers\FormController;
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
        return FormController::getProjectActivityFormInput($form);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Activity::query()->where('area_id', auth()->user()->area_id))
            ->columns([
//                Tables\Columns\TextColumn::make('code')
//                    ->label('รหัส')
//                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('ชื่อกิจกรรม/ผลงานการขับเคลื่อนนโยบายสู่การปฏิบัติ')
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
//                Tables\Actions\EditAction::make(),
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
