<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BudgetYear;
use App\Models\RelateGroup;
use App\Models\RelateType;

class RelateTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RelateType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'label' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'name' => $this->faker->name(),
            'budget_year_id' => BudgetYear::factory(),
            'relate_group_id' => RelateGroup::factory(),
            'is_parent' => $this->faker->boolean(),
            'is_single' => $this->faker->boolean(),
            'parent_name' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'order' => $this->faker->word(),
        ];
    }
}
