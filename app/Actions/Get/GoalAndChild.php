<?php

namespace App\Actions\Get;

use App\Models\AreaGoal;
use Lorisleiva\Actions\Concerns\AsAction;

class GoalAndChild
{
    use AsAction;

    public function handle(int $area_id, int $budget_year_id)
    {
        return AreaGoal::where('area_id', $area_id)->where('budget_year_id', $budget_year_id)->with([
            'startegy' => function($q) {
                $q->with([
                    'target'
                ]);
            }
        ])->get();
    }
}
