<?php

namespace App\Filament\Admin\Resources\RelateGroupResource\Pages;

use App\Filament\Admin\Resources\RelateGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelateGroups extends ListRecords
{
    protected static string $resource = RelateGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
