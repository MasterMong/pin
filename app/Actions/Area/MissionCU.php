<?php

namespace App\Actions\Area;

use App\Models\AreaMission;
use Lorisleiva\Actions\Concerns\AsAction;

class MissionCU
{
    use AsAction;

    public function handle(string $area_id, int $budget_year_id,string $detail)
    {
        $area_mission = AreaMission::where('area_id', $area_id)->where('budget_year_id', $budget_year_id)->first();
        if (empty($area_mission)) {
            $area_mission = AreaMission::create([
                'area_id' => $area_id,
                'budget_year_id' => $budget_year_id,
                'detail' => $detail,
            ]);
        } else {
            $area_mission->detail = $detail;
            $area_mission->save();
        }
        return $area_mission;
    }
}
