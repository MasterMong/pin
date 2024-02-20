<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Area;
use App\Models\AreaAttachment;
use App\Models\AreaAttachmentType;
use App\Models\AreaAttachmentTypes;
use App\Models\BudgetYear;

class AreaAttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AreaAttachment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::factory(),
            'area_attachment_type_id' => AreaAttachmentType::factory(),
            'budget_year_id' => BudgetYear::factory(),
            'attr' => '{}',
            'area_attachment_types_id' => AreaAttachmentTypes::factory(),
        ];
    }
}
