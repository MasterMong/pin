<?php

namespace App\Actions\Area;

use App\Models\AreaGoal;
use Lorisleiva\Actions\Concerns\AsAction;

class GoalCU
{
    use AsAction;

    public function handle(int $area_id, int $budget_year_id, array $data)
    {
        // TODO nove
        if($data['id'] == 0) {
            $area_goal = AreaGoal::create([
                'area_id' => $area_id,
                'budget_year_id' => $budget_year_id,
                'detail' => $data['detail']
            ]);
        }else {
            $area_goal = AreaGoal::where('id', $data['id'])->first();
            $area_goal->detail = $data['detail'];
            $area_goal->save();
        }
        return $area_goal;
    }
}
