<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AreaAttachmentTypes;

class AreaAttachmentTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AreaAttachmentTypes::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'label' => $this->faker->regexify('[A-Za-z0-9]{1000}'),
            'is_single' => $this->faker->boolean(),
            'file_types' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'req_attr' => '{}',
        ];
    }
}
