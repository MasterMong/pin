<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RelateTypeResource\Pages;
use App\Filament\Admin\Resources\RelateTypeResource\RelationManagers;
use App\Models\RelateType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RelateTypeResource extends Resource
{
    protected static ?string $model = RelateType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('budget_year_id')
                    ->relationship('budgetYear', 'name')
                    ->required(),
                Forms\Components\Select::make('relate_group_id')
                    ->relationship('relateGroup', 'id')
                    ->required(),
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->maxLength(1000),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Toggle::make('is_parent')
                    ->required(),
                Forms\Components\Toggle::make('is_single')
                    ->required(),
                Forms\Components\TextInput::make('parent_name')
                    ->maxLength(100),
                Forms\Components\TextInput::make('order')
                    ->maxLength(255)
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('budgetYear.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('relateGroup.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_parent')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_single')
                    ->boolean(),
                Tables\Columns\TextColumn::make('parent_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
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
            'index' => Pages\ListRelateTypes::route('/'),
            'create' => Pages\CreateRelateType::route('/create'),
            'view' => Pages\ViewRelateType::route('/{record}'),
            'edit' => Pages\EditRelateType::route('/{record}/edit'),
        ];
    }
}
