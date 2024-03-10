<?php

namespace App\Filament\Admin\Resources\RelateTypeResource\Pages;

use App\Filament\Admin\Resources\RelateTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelateTypes extends ListRecords
{
    protected static string $resource = RelateTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
