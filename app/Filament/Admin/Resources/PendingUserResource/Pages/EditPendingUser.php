<?php

namespace App\Filament\Admin\Resources\PendingUserResource\Pages;

use App\Filament\Admin\Resources\PendingUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingUser extends EditRecord
{
    protected static string $resource = PendingUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
