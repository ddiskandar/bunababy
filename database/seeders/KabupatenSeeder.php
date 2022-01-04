<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kabupatens')->insert([
            ['name' => 'Kota Bandung'],
            ['name' => 'Kabupaten Bandung'],
            ['name' => 'Kabupaten Bandung Barat'],
            ['name' => 'Cimahi'],
        ]);
    }
}
