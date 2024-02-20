<?php

namespace App\Filament\Admin\Resources\AreaMemberTypeResource\Pages;

use App\Filament\Admin\Resources\AreaMemberTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAreaMemberType extends EditRecord
{
    protected static string $resource = AreaMemberTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
