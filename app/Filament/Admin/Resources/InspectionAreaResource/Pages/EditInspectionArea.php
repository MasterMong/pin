<?php

namespace App\Filament\Admin\Resources\InspectionAreaResource\Pages;

use App\Filament\Admin\Resources\InspectionAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInspectionArea extends EditRecord
{
    protected static string $resource = InspectionAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
