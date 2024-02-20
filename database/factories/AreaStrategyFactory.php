<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\AreaGoal;
use App\Models\AreaStrategy;
use App\Models\BudgetYear;

class AreaStrategyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AreaStrategy::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::factory(),
            'area_goal_id' => AreaGoal::factory(),
            'budget_year_id' => BudgetYear::factory(),
            'detail' => $this->faker->regexify('[A-Za-z0-9]{2000}'),
        ];
    }
}
