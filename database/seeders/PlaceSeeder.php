<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('places')->insert([
            [
                'id'   => 1,
                'name' => 'Homecare',
                'desc' => 'Di rumah sesuai alamat lokasi',
                'type' => 1, // 1 = homecare, 2 = klinik
                'transport_duration' => 40, // 40 menit
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'   => 2,
                'name' => 'Klinik Cimahi',
                'desc' => 'Komplek Nata Endah Blok N No. 170, Cibabat, Cimahi',
                'type' => 2, // 1 = homecare, 2 = klinik
                'transport_duration' => 0,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id'   => 3,
                'name' => 'Klinik Bandung',
                'desc' => 'Alamat Klinik Bandung',
                'type' => 2, // 1 = homecare, 2 = klinik
                'transport_duration' => 0,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
