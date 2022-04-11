<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Buna Treatment', 'order' => 2],
            ['name' => 'Baby Treatment', 'order' => 1],
            ['name' => 'Bunababy Class', 'order' => 3],
        ]);
    }
}
