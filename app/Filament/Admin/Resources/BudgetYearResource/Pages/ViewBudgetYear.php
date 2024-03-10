<?php

namespace App\Filament\Admin\Resources\BudgetYearResource\Pages;

use App\Filament\Admin\Resources\BudgetYearResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBudgetYear extends ViewRecord
{
    protected static string $resource = BudgetYearResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
