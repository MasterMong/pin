<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BudgetYear;
use App\Models\RelateGroup;

class RelateGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RelateGroup::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'budget_year_id' => BudgetYear::factory(),
            'label' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'order' => $this->faker->word(),
        ];
    }
}
