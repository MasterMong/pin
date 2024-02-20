<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\AreaType;
use App\Models\District;
use App\Models\InspectionArea;
use App\Models\Province;
use App\Models\Region;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'name' => $this->faker->name(),
            'address' => $this->faker->regexify('[A-Za-z0-9]{600}'),
            'zip_code' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'tel' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'num_person' => $this->faker->numberBetween(-10000, 10000),
            'num_school' => $this->faker->numberBetween(-10000, 10000),
            'num_teacher' => $this->faker->numberBetween(-10000, 10000),
            'num_student' => $this->faker->numberBetween(-10000, 10000),
            'website' => $this->faker->regexify('[A-Za-z0-9]{600}'),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'inspection_area_id' => InspectionArea::factory(),
            'area_type_id' => AreaType::factory(),
            'district_id' => District::factory(),
            'province_id' => Province::factory(),
            'region_id' => Region::factory(),
            'etc' => '{}',
        ];
    }
}
