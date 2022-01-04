<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kecamatans')->insert([
            [
                'kabupaten_id' => 1,
                'name' => 'Cicendo',
                'distance' => 7
            ],
            [
                'kabupaten_id' => 1,
                'name' => 'Bojong Loa',
                'distance' => 7
            ],
            [
                'kabupaten_id' => 2,
                'name' => 'Cibiru',
                'distance' => 7
            ],
            [
                'kabupaten_id' => 2,
                'name' => 'Sekemala',
                'distance' => 7
            ],
            [
                'kabupaten_id' => 3,
                'name' => 'Lembang',
                'distance' => 7
            ],
            [
                'kabupaten_id' => 4,
                'name' => 'Cimahi Utara',
                'distance' => 7
            ],
        ]);
    }
}
