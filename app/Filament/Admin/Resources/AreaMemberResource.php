<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AreaMemberResource\Pages;
use App\Filament\Admin\Resources\AreaMemberResource\RelationManagers;
use App\Models\AreaMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AreaMemberResource extends Resource
{
    protected static ?string $model = AreaMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('area_member_type_id')
                    ->relationship('areaMemberType', 'name')
                    ->required(),
                Forms\Components\Select::make('area_id')
                    ->relationship('area', 'name')
                    ->required(),
                Forms\Components\FileUpload::make('cover_image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(300),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('areaMemberType.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('area.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('cover_image'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListAreaMembers::route('/'),
            'create' => Pages\CreateAreaMember::route('/create'),
            'edit' => Pages\EditAreaMember::route('/{record}/edit'),
        ];
    }
}
