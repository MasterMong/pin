<?php

namespace App\Filament\Admin\Resources\PendingUserResource\Pages;

use App\Filament\Admin\Resources\PendingUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPendingUser extends ViewRecord
{
    protected static string $resource = PendingUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
