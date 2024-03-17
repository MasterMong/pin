<?php

namespace App\Filament\Resources\ActivityResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActivityOverview extends BaseWidget
{
    public int $count_activity;
    public int $count_beneficiary;
    public string $count_innovation;
    protected function getStats(): array
    {
        return [
            Stat::make('จำนวนกิจกรรม', $this->count_activity),
//            Stat::make('จำนวนผู้ได้รับประโยชน์', $this->count_beneficiary),
//            Stat::make('จำนวนนวัตกรรม', $this->count_innovation),
        ];
    }
}
