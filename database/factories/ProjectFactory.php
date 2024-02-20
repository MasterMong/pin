<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\AreaStrategy;
use App\Models\BudgetYear;
use App\Models\Project;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

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
            'objective' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'indicator' => $this->faker->text(),
            'duration' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'date_start' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'date_end' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'budget' => $this->faker->randomFloat(0, 0, 9999999999.),
            'area_strategy_id' => AreaStrategy::factory(),
            'is_pa_of_manager' => $this->faker->boolean(),
            'problem' => $this->faker->text(),
            'suggestions' => $this->faker->text(),
            'progress' => $this->faker->numberBetween(-10000, 10000),
            'relate_items' => '{}',
            'handler_name' => $this->faker->word(),
            'status' => $this->faker->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
