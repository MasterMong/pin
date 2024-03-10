<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RelateGroupResource\Pages;
use App\Filament\Admin\Resources\RelateGroupResource\RelationManagers;
use App\Models\RelateGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RelateGroupResource extends Resource
{
    protected static ?string $model = RelateGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('budget_year_id')
                    ->relationship('budgetYear', 'name')
                    ->required(),
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->maxLength(1000),
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
                Tables\Columns\TextColumn::make('label')
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
            'index' => Pages\ListRelateGroups::route('/'),
            'create' => Pages\CreateRelateGroup::route('/create'),
            'view' => Pages\ViewRelateGroup::route('/{record}'),
            'edit' => Pages\EditRelateGroup::route('/{record}/edit'),
        ];
    }
}
