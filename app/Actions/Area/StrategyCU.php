<?php

namespace App\Actions\Area;

use App\Models\AreaStrategy;
use Lorisleiva\Actions\Concerns\AsAction;

class StrategyCU
{
    use AsAction;

    public function handle(int $area_id, int $budget_year_id, int $goal_id, $strategy)
    {
        $model = AreaStrategy::where('id', $strategy['id'])->where('area_id', $area_id)->first();
        if (empty($model)) {
            if ($strategy['id'] == 0) {
                return AreaStrategy::create([
                    'area_goal_id' => $goal_id,
                    'area_id' => $area_id,
                    'budget_year_id' => $budget_year_id,
                    'detail' => $strategy['detail'],
                ]);
            }
        } else {
            $model = AreaStrategy::where('id', $strategy['id'])->first();
            $model->detail = $strategy['detail'];
            $model->save();
            return $model;
        }
    }
}
