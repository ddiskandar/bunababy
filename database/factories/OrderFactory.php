<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'client_user_id' => User::factory(['type' => User::CLIENT]),
            'midwife_user_id' => User::factory(['type' => User::MIDWIFE]),
            'address_id' => Address::factory(),
            'total_price' => 0,
        ];
    }
}
