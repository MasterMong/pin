<?php

namespace App\Filament\Admin\Resources\RelateItemResource\Pages;

use App\Filament\Admin\Resources\RelateItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRelateItem extends EditRecord
{
    protected static string $resource = RelateItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
