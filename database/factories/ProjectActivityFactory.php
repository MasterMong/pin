<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\BudgetYear;
use App\Models\Project;
use App\Models\ProjectActivity;

class ProjectActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectActivity::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::factory(),
            'project_id' => Project::factory(),
            'budget_year_id' => BudgetYear::factory(),
            'name' => $this->faker->name(),
            'process' => $this->faker->text(),
            'target_area' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'result' => $this->faker->text(),
            'count_beneficiary' => $this->faker->numberBetween(-10000, 10000),
            'is_success' => $this->faker->boolean(),
            'unsuccessful_reason' => $this->faker->text(),
        ];
    }
}
