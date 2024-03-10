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
            'name' => $this->faker->name(),
            'attachment' => $this->faker->word(),
            'url' => $this->faker->url(),
        ];
    }
}
