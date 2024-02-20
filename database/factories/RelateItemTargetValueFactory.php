<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BudgetYear;
use App\Models\RelateItem;
use App\Models\RelateItemTargetValue;

class RelateItemTargetValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RelateItemTargetValue::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'label' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'budget_year_id' => BudgetYear::factory(),
            'relate_item_id' => RelateItem::factory(),
            'value' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
