<?php

namespace App\Filament\Admin\Resources\SubDistrictResource\Pages;

use App\Filament\Admin\Resources\SubDistrictResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubDistrict extends ViewRecord
{
    protected static string $resource = SubDistrictResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
