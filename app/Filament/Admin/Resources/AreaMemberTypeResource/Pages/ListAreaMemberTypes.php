<?php

namespace App\Filament\Admin\Resources\AreaMemberTypeResource\Pages;

use App\Filament\Admin\Resources\AreaMemberTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAreaMemberTypes extends ListRecords
{
    protected static string $resource = AreaMemberTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
