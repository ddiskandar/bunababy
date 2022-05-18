<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'site_name' => 'Bunababy Care',
            'site_location' => 'Komplek Nata Endah Blok N No. 170, Cibabat, Cimahi',
            'site_desc' => 'Mom and Baby Care',
            'ig' => '@bunababy_care',
            'phone' => '08997897991',
            'account' => 'BCA 2810417067',
            'account_name' => 'a/n Febrianti Nur Azizah',
        ]);
    }
}
