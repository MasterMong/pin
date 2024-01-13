<?php

namespace App\Actions\Area;

use App\Models\AreaStartegy;
use Lorisleiva\Actions\Concerns\AsAction;

class StartegyCU
{
    use AsAction;

    public function handle(int $area_id, int $budget_year_id, int $goal_id, $startegy)
    {
        $model = AreaStartegy::where('id', $startegy['id'])->where('area_id', $area_id)->first();
        if (empty($model)) {
            if ($startegy['id'] == 0) {
                return AreaStartegy::create([
                    'area_goal_id' => $goal_id,
                    'area_id' => $area_id,
                    'budget_year_id' => $budget_year_id,
                    'detail' => $startegy['detail'],
                ]);
            }
        } else {
            $model = AreaStartegy::where('id', $startegy['id'])->first();
            $model->detail = $startegy['detail'];
            $model->save();
            return $model;
        }
    }
}
