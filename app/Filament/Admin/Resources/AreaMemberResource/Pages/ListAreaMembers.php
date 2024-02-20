<?php

namespace App\Filament\Admin\Resources\AreaMemberResource\Pages;

use App\Filament\Admin\Resources\AreaMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAreaMembers extends ListRecords
{
    protected static string $resource = AreaMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
