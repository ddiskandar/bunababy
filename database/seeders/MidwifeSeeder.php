<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MidwifeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('midwives')->insert([
            ['name' => 'Bidan Febri', 'email' => 'bidan1@bunababycare.com'],
            ['name' => 'Bidan Lina', 'email' => 'bidan2@bunababycare.com'],
            ['name' => 'Bidan Ririn', 'email' => 'bidan3@bunababycare.com'],
            ['name' => 'Bidan Ina', 'email' => 'bidan4@bunababycare.com'],
            ['name' => 'Bidan Suci', 'email' => 'bidan5@bunababycare.com'],
        ]);
    }
}
