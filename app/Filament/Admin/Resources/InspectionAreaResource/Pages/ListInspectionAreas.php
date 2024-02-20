<?php

namespace App\Filament\Admin\Resources\InspectionAreaResource\Pages;

use App\Filament\Admin\Resources\InspectionAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInspectionAreas extends ListRecords
{
    protected static string $resource = InspectionAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
