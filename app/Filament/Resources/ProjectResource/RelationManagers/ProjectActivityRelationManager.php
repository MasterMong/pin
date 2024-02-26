<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Http\Controllers\FormController;
use App\Http\Controllers\SettingController;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ProjectActivityRelationManager extends RelationManager
{
    protected static string $relationship = 'projectActivities';

    public ?int $area_id;

    public function mount(): void
    {
        $this->area_id = Auth::user()->area_id;
    }

    public function isReadOnly(): bool
    {
        return False;
    }

    public function form(Form $form): Form
    {
        return FormController::getProjectActivityFormInput($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['area_id'] = Auth::user()->area_id;
                        $data['project_id'] = $this->getOwnerRecord()->id;
                        $data['budget_year_id'] = SettingController::getSetting('budget_year');
                        $data['process'] = '';
                        $data['result'] = '';
                        $data['count_beneficiary'] = 0;
                        Notification::make()
                            ->title('เพิ่มกิจกรรมแล้ว')
                            ->success()
                            ->send();
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
