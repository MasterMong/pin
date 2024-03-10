<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Activity;
use App\Models\Area;
use App\Models\AreaStrategy;
use App\Models\BudgetYear;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::factory(),
            'budget_year_id' => BudgetYear::factory(),
            'name' => $this->faker->name(),
            'code' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'duration' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'date_start' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'date_end' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'q1' => $this->faker->word(),
            'q2' => $this->faker->word(),
            'q3' => $this->faker->word(),
            'q4' => $this->faker->word(),
            'process' => $this->faker->text(),
            'target_area' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'relate_items' => '{}',
            'area_strategy_id' => AreaStrategy::factory(),
            'is_pa_of_manager' => $this->faker->boolean(),
            'progress' => $this->faker->numberBetween(-10000, 10000),
            'problem' => $this->faker->text(),
            'suggestions' => $this->faker->text(),
            'beneficiary' => '{}',
            'is_success' => $this->faker->boolean(),
            'galleries' => '{}',
            'urls' => $this->faker->regexify('[A-Za-z0-9]{2000}'),
            'handler_name' => $this->faker->word(),
            'status' => $this->faker->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
