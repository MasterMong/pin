<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\AreaStrategy;
use App\Models\AreaTarget;
use App\Models\BudgetYear;

class AreaTargetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AreaTarget::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::factory(),
            'area_strategy_id' => AreaStrategy::factory(),
            'budget_year_id' => BudgetYear::factory(),
            'detail' => $this->faker->regexify('[A-Za-z0-9]{2000}'),
            'indicator' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'unit' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'target_value' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
        ];
    }
}
