<?php

namespace App\Filament\Admin\Resources\RelateItemResource\Pages;

use App\Filament\Admin\Resources\RelateItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRelateItem extends ViewRecord
{
    protected static string $resource = RelateItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
