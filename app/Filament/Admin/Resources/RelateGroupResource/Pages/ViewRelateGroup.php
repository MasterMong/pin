<?php

namespace App\Filament\Admin\Resources\RelateGroupResource\Pages;

use App\Filament\Admin\Resources\RelateGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRelateGroup extends ViewRecord
{
    protected static string $resource = RelateGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
