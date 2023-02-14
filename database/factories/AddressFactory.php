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
            'label' => 'rumah',
            'address' => $this->faker->streetAddress(),
            'desa' => $this->faker->city(),
            'kecamatan_id' => rand(1, 79),
        ];
    }
}
