<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AreaResource\Pages;
use App\Filament\Admin\Resources\AreaResource\RelationManagers;
use App\Models\Area;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AreaResource extends Resource
{
    protected static ?string $model = Area::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('inspection_area_id')
                    ->relationship('inspectionArea', 'name')
                    ->required(),
                Forms\Components\Select::make('area_type_id')
                    ->relationship('areaType', 'name')
                    ->required(),
                Forms\Components\Select::make('district_id')
                    ->relationship('district', 'id')
                    ->required(),
                Forms\Components\Select::make('province_id')
                    ->relationship('province', 'id')
                    ->required(),
                Forms\Components\Select::make('region_id')
                    ->relationship('region', 'name')
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('code3d')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('address')
                    ->maxLength(600),
                Forms\Components\TextInput::make('zip_code')
                    ->maxLength(5),
                Forms\Components\TextInput::make('tel')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('num_person')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('num_school')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('num_teacher')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('num_student')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('website')
                    ->required()
                    ->maxLength(600),
                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('etc'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('inspectionArea.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('areaType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('district.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('province.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('region.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code3d')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tel')
                    ->searchable(),
                Tables\Columns\TextColumn::make('num_person')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('num_school')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('num_teacher')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('num_student')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->searchable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAreas::route('/'),
            'create' => Pages\CreateArea::route('/create'),
            'view' => Pages\ViewArea::route('/{record}'),
            'edit' => Pages\EditArea::route('/{record}/edit'),
        ];
    }
}
