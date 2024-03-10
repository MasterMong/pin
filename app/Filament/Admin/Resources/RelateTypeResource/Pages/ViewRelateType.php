<?php

namespace App\Filament\Admin\Resources\RelateTypeResource\Pages;

use App\Filament\Admin\Resources\RelateTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRelateType extends ViewRecord
{
    protected static string $resource = RelateTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
