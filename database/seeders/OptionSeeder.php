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
            'site_name' => 'Bunababy',
            'site_location' => 'Bandung',
            'site_desc' => 'Mom and Baby Care',
            'ig' => '/bunababy.care',
            'wa_admin' => '6285624028940',
            'wa_owner' => '6285624343181',
            'account' => 'BCA 2810417067',
            'account_name' => 'a/n Febrianti Nur Azizah',
        ]);
    }
}
