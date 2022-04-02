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
            'no_reg' => Str::random(10),
            'invoice' => Str::random(10),
            'client_user_id' => User::factory(['type' => User::CLIENT]),
            'midwife_user_id' => User::factory(['type' => User::MIDWIFE]),
            'address_id' => Address::factory(),
            'total_price' => 100000,
            'total_duration' => 45,
            'total_transport' => 40000,
            'additional' => 0,
            'date' => $this->faker->dateTimeThisMonth(),
            'start_time' => '08:00:00',
            'end_time' => '08:45:00',
        ];
    }
}
