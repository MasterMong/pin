<?php

namespace App\Filament\Admin\Resources\AreaTypeResource\Pages;

use App\Filament\Admin\Resources\AreaTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAreaType extends EditRecord
{
    protected static string $resource = AreaTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
