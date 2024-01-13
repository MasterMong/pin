<?php

namespace App\Actions\Area;

use App\Models\AreaTarget;
use Lorisleiva\Actions\Concerns\AsAction;

class TargetCU
{
    use AsAction;

    public function handle(int $area_id, int $budget_year_id, int $startegy_id, $target)
    {
        $model = AreaTarget::where('id', $target['id'])->where('area_id', $area_id)->first();
        if (empty($model)) {
            if ($target['id'] == 0) {
                return AreaTarget::create([
                    'area_id' => $area_id,
                    'area_startegy_id' => $startegy_id,
                    'budget_year_id' => $budget_year_id,
                    'indicator' => $target['indicator'],
                    'name' => $target['name'],
                    'target_value' => $target['target_value'],
                    'unit' => $target['unit'],
                ]);
            }
        } else {
            $model = AreaTarget::where('id', $target['id'])->first();
            $model->indicator = $target['indicator'];
            $model->name = $target['name'];
            $model->target_value = $target['target_value'];
            $model->unit = $target['unit'];
            $model->save();
            return $model;
        }
    }
}
