<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('treatments')->insert([
            [
                'category_id' => 1,
                'name' => 'Baby Spa',
                'price' => 150000,
                'duration' => 60,
                'desc' => 'Baby swim, baby massage, baby gym'
            ],
            [
                'category_id' => 1,
                'name' => 'Baby Package',
                'price' => 95000,
                'duration' => 60,
                'desc' => 'Baby massage, baby gym, baby brain gym'
            ],
            [
                'category_id' => 1,
                'name' => 'Happy Pregnancy',
                'price' => 135000,
                'duration' => 60,
                'desc' => 'Pijat Hamil, periksa hamil, totok wajah'
            ],
            [
                'category_id' => 1,
                'name' => 'Happy Mommy',
                'price' => 135000,
                'duration' => 60,
                'desc' => 'Pijat nifas, periksa nifas, totok wajah'
            ],

            [
                'category_id' => 2,
                'name' => 'Pijat Bayi Sehat',
                'price' => 75000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 2,
                'name' => 'Pijat Balita Sehat',
                'price' => 75000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 2,
                'name' => 'Baby Package',
                'price' => 95000,
                'duration' => 60,
                'desc' => 'baby massage, baby gym and brain gym'
            ],
            [
                'category_id' => 2,
                'name' => 'Pijat Pediatric',
                'price' => 90000,
                'duration' => 60,
                'desc' => 'batuk pilek/diare/stimulasi jalan/stimulasi tumbuh gigi/konstipasi nafsu makan'
            ],
            [
                'category_id' => 2,
                'name' => 'Mandi Ceria',
                'price' => 35000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 2,
                'name' => 'Tumbuh Kembang Anak',
                'price' => 25000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 2,
                'name' => 'Tindik',
                'price' => 50000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 2,
                'name' => 'Cukur Rambut',
                'price' => 55000,
                'duration' => 60,
                'desc' => '',
            ],

            [
                'category_id' => 3,
                'name' => 'Pijat Hamil + Periksa Hamil',
                'price' => 110000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 3,
                'name' => 'Pijat Nifas + Periksa Nifas',
                'price' => 110000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 3,
                'name' => 'Terapi Bendungan ASI',
                'price' => 70000,
                'duration' => 30,
                'desc' => '',
            ],
            [
                'category_id' => 3,
                'name' => 'Paket Laktasi',
                'price' => 85000,
                'duration' => 60,
                'desc' => 'Breastcare + Pijat Laktasi'
            ],
            [
                'category_id' => 3,
                'name' => 'Pijat Oksitosin',
                'price' => 75000,
                'duration' => 60,
                'desc' => 'Termasuk pemeriksa kehamilan'
            ],
            [
                'category_id' => 3,
                'name' => 'Private Prenatal Gentle Yoga',
                'price' => 110000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 3,
                'name' => 'Totok Wajah',
                'price' => 30000,
                'duration' => 60,
                'desc' => 'Breastcare + Pijat Laktasi'
            ],
            [
                'category_id' => 3,
                'name' => 'Konsultasi Mantap KB',
                'price' => 30000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 3,
                'name' => 'Konsultasi Pra Nikah',
                'price' => 50000,
                'duration' => 60,
                'desc' => '',
            ],
            [
                'category_id' => 3,
                'name' => 'Pijat Rintik Hujan (RDT)',
                'price' => 400000,
                'duration' => 60,
                'desc' => 'free totok wajah',
            ],
        ]);
    }
}
