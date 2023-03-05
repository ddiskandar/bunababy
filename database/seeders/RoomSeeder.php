<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            ['name' => 'Ruang Baby Spa', 'place_id' => 2],
            ['name' => 'Ruang Tengah', 'place_id' => 2],

            ['name' => 'Ruang Baby Spa', 'place_id' => 3],
            ['name' => 'Ruang Tengah', 'place_id' => 3],
        ]);
    }
}
