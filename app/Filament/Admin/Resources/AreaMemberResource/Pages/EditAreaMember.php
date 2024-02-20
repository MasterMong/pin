<?php

namespace App\Filament\Admin\Resources\AreaMemberResource\Pages;

use App\Filament\Admin\Resources\AreaMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAreaMember extends EditRecord
{
    protected static string $resource = AreaMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
