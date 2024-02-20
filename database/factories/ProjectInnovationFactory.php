<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\BudgetYear;
use App\Models\Project;
use App\Models\ProjectActivity;
use App\Models\ProjectInnovation;

class ProjectInnovationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectInnovation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::factory(),
            'project_id' => Project::factory(),
            'project_activity_id' => ProjectActivity::factory(),
            'budget_year_id' => BudgetYear::factory(),
            'attachment' => $this->faker->word(),
            'name' => $this->faker->name(),
            'type' => $this->faker->regexify('[A-Za-z0-9]{600}'),
            'url' => '{}',
            'detail' => $this->faker->text(),
            'use' => $this->faker->text(),
            'problem' => $this->faker->text(),
            'suggest' => $this->faker->text(),
        ];
    }
}
