<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proprietary;
use App\Models\Brand;
use App\Models\Class;
use App\Models\Section;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->sentence,
            'description' => $this->faker->paragraph,
            'history' => $this->faker->paragraph(100),
            'detail' => $this->faker->text,
            'date' => $this->faker->date,
            'identification_code' => $this->faker->unique()->numberBetween(1, 1000),
            'image' => $this->faker->imageUrl(500, 500),
            'validation' => $this->faker->boolean,
            'section_id' => Section::pluck('id')->random(),
            'proprietary_id' => Proprietary::pluck('id')->random(),
        ];
    }
}
