<?php

namespace App\Filament\Admin\Resources\BudgetYearResource\Pages;

use App\Filament\Admin\Resources\BudgetYearResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBudgetYear extends EditRecord
{
    protected static string $resource = BudgetYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
