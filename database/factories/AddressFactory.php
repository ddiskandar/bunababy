<?php

namespace Database\Factories;

use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_user_id' => User::factory(),
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->phoneNumber(),
            'rt' => $this->faker->numberBetween(1, 12),
            'rw' => $this->faker->numberBetween(1, 12),
            'desa' => $this->faker->city(),
            'kecamatan_id' => rand(1,79),
        ];
    }
}
