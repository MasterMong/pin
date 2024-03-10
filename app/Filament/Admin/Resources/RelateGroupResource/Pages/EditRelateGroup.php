<?php

namespace App\Filament\Admin\Resources\RelateGroupResource\Pages;

use App\Filament\Admin\Resources\RelateGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRelateGroup extends EditRecord
{
    protected static string $resource = RelateGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
