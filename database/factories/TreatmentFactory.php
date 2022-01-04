<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->words(2),
            'price' => $this->faker->numberBetween(35000, 150000),
            'duration' => $this->faker->numberBetween(30, 60),
        ];
    }
}
