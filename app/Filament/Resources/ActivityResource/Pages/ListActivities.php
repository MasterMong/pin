<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getHeaderWidgets(): array
    {
//        $count_innovation = \Auth::user()->area()->ActivityInnovation();
// TODO
        return [
            ActivityResource\Widgets\ActivityOverview::make([
                'count_activity' => $this->getAllTableRecordsCount(),
//                'count_beneficiary' => $this->getAllTableRecordsCount(),
//                'count_innovation' => json_encode($count_innovation),
            ]),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
