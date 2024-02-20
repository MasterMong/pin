<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AreaStrategy;
use App\Models\District;
use App\Models\Province;
use App\Models\SubDistrict;

class SubDistrictFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubDistrict::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->numberBetween(-10000, 10000),
            'name_in_thai' => $this->faker->regexify('[A-Za-z0-9]{300}'),
            'name_in_english' => $this->faker->regexify('[A-Za-z0-9]{300}'),
            'zip_code' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'province_id' => Province::factory(),
            'district_id' => District::factory(),
            'area_strategy_id' => AreaStrategy::factory(),
        ];
    }
}
