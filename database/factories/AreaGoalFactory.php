<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\AreaGoal;
use App\Models\AreaMission;
use App\Models\AreaVision;
use App\Models\BudgetYear;

class AreaGoalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AreaGoal::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::factory(),
            'budget_year_id' => BudgetYear::factory(),
            'area_vision_id' => AreaVision::factory(),
            'detail' => $this->faker->regexify('[A-Za-z0-9]{2000}'),
            'area_mission_id' => AreaMission::factory(),
        ];
    }
}
