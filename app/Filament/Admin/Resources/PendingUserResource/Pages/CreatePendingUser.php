<?php

namespace App\Filament\Admin\Resources\PendingUserResource\Pages;

use App\Filament\Admin\Resources\PendingUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendingUser extends CreateRecord
{
    protected static string $resource = PendingUserResource::class;
}
