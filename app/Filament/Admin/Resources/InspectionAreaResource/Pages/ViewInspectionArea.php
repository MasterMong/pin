<?php

namespace App\Filament\Admin\Resources\InspectionAreaResource\Pages;

use App\Filament\Admin\Resources\InspectionAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInspectionArea extends ViewRecord
{
    protected static string $resource = InspectionAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
