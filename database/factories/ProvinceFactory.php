<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Province;
use App\Models\Region;

class ProvinceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Province::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->numberBetween(-10000, 10000),
            'name_in_thai' => $this->faker->regexify('[A-Za-z0-9]{300}'),
            'name_in_english' => $this->faker->regexify('[A-Za-z0-9]{300}'),
            'region_id' => Region::factory(),
        ];
    }
}
