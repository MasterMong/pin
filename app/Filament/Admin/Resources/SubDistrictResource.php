<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SubDistrictResource\Pages;
use App\Filament\Admin\Resources\SubDistrictResource\RelationManagers;
use App\Models\SubDistrict;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubDistrictResource extends Resource
{
    protected static ?string $model = SubDistrict::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('province_id')
                    ->relationship('province', 'id')
                    ->required(),
                Forms\Components\Select::make('district_id')
                    ->relationship('district', 'id')
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name_in_thai')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('name_in_english')
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('zip_code')
                    ->maxLength(5),
                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->maxLength(30),
                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->maxLength(30),
                Forms\Components\Select::make('area_strategy_id')
                    ->relationship('areaStrategy', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('province.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('district.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name_in_thai')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name_in_english')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->searchable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->searchable(),
                Tables\Columns\TextColumn::make('areaStrategy.id')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListSubDistricts::route('/'),
            'create' => Pages\CreateSubDistrict::route('/create'),
            'view' => Pages\ViewSubDistrict::route('/{record}'),
            'edit' => Pages\EditSubDistrict::route('/{record}/edit'),
        ];
    }
}
