<?php

namespace App\Actions\Area;

use App\Models\AreaVision;
use Lorisleiva\Actions\Concerns\AsAction;

class VisionCU
{
    use AsAction;

    public function handle(string $area_id, int $budget_year_id, string $detail)
    {
        $area_vision = AreaVision::where('area_id', $area_id)->where('budget_year_id', $budget_year_id)->first();
        if (empty($area_vision)) {
            $area_vision = AreaVision::create([
                'area_id' => $area_id,
                'budget_year_id' => $budget_year_id,
                'detail' => $detail,
            ]);
        } else {
            $area_vision->detail = $detail;
            $area_vision->save();
        }
        return $area_vision;
    }

}
