<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Activity;
use App\Models\ActivityInnovation;
use App\Models\Area;
use App\Models\BudgetYear;

class ActivityInnovationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivityInnovation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::factory(),
            'activity_id' => Activity::factory(),
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
