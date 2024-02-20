<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BudgetYear;
use App\Models\RelateItem;
use App\Models\RelateType;

class RelateItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RelateItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'label' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'budget_year_id' => BudgetYear::factory(),
            'relate_type_id' => RelateType::factory(),
            'ref' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'parent_item_ref' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'order' => $this->faker->word(),
            'req_value' => $this->faker->boolean(),
        ];
    }
}
