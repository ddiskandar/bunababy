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
            'wa_admin' => '085624028940',
            'wa_owner' => '085624343181',
            'account' => '1485963254',
            'account_name' => 'Febrianti Nur Azizah',
        ]);
    }
}
