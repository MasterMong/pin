<?php

namespace App\Filament\Resources\AreaVisionResource\Pages;

use App\Filament\Resources\AreaVisionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAreaVisions extends ManageRecords
{
    protected static string $resource = AreaVisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->mutateFormDataUsing(function (array $data): array {
                return $data;
            })
        ];
    }
}
