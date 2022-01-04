<?php

namespace Database\Factories;

use App\Models\Kabupaten;
use Illuminate\Database\Eloquent\Factories\Factory;

class KecamatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kabupaten_id' => Kabupaten::factory(),
            'name' => $this->faker->city(),
            'distance' => rand(1, 29)
        ];
    }
}
