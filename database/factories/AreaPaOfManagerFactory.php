<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\AreaPaOfManager;
use App\Models\BudgetYear;

class AreaPaOfManagerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AreaPaOfManager::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::factory(),
            'budget_year_id' => BudgetYear::factory(),
            'name' => $this->faker->name(),
        ];
    }
}
