<?php

namespace App\Filament\Admin\Resources\AreaResource\Pages;

use App\Filament\Admin\Resources\AreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewArea extends ViewRecord
{
    protected static string $resource = AreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
