<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\AreaMember;
use App\Models\AreaMemberType;
use App\Models\BudgetYear;

class AreaMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AreaMember::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_member_type_id' => AreaMemberType::factory(),
            'area_id' => Area::factory(),
            'cover_image' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'name' => $this->faker->name(),
            'budget_year_id' => BudgetYear::factory(),
        ];
    }
}
