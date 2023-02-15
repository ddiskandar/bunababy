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
            'no_reg' => 'A' . '1' . str_replace('-', '', today()->toDateString()) . rand(111, 999),
            'invoice' => 'INV/' . str_replace('-', '', today()->toDateString()) . '/BBC/' . rand(1111111111, 9999999999),
            'client_user_id' => User::factory(['type' => User::CLIENT]),
            'midwife_user_id' => User::factory(['type' => User::MIDWIFE]),
            'address_id' => Address::factory(),
            'total_price' => 0,
            'total_duration' => 0,
            'total_transport' => 40000,
            'adjustment_amount' => 0,
        ];
    }
}
