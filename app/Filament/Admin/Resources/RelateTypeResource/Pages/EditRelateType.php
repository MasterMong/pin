<?php

namespace App\Filament\Admin\Resources\RelateTypeResource\Pages;

use App\Filament\Admin\Resources\RelateTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRelateType extends EditRecord
{
    protected static string $resource = RelateTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
