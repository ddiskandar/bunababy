<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'client_user_id' => User::factory(),
            'midwife_user_id' => User::factory(['role' => 'midwife']),
            'address_id' => Address::factory(),
            'total_price' => 95000,
            'total_duration' => 45,
            'total_transport' => 15000,
            'total_fee_apd' => 10000,
            'date' => today(),
            'start_time' => '08:00:00',
            'end_time' => '08:45:00',
        ];
    }
}
