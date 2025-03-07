<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slots')->insert([
            ['place_id' => 1, 'time' => Carbon::parse('08:00:00')],
            ['place_id' => 1, 'time' => Carbon::parse('08:15:00')],
            ['place_id' => 1, 'time' => Carbon::parse('08:30:00')],
            ['place_id' => 1, 'time' => Carbon::parse('08:45:00')],
            ['place_id' => 1, 'time' => Carbon::parse('09:00:00')],
            ['place_id' => 1, 'time' => Carbon::parse('09:15:00')],
            ['place_id' => 1, 'time' => Carbon::parse('09:30:00')],
            ['place_id' => 1, 'time' => Carbon::parse('09:45:00')],
            ['place_id' => 1, 'time' => Carbon::parse('10:00:00')],
            ['place_id' => 1, 'time' => Carbon::parse('10:15:00')],
            ['place_id' => 1, 'time' => Carbon::parse('10:30:00')],
            ['place_id' => 1, 'time' => Carbon::parse('10:45:00')],
            ['place_id' => 1, 'time' => Carbon::parse('13:00:00')],
            ['place_id' => 1, 'time' => Carbon::parse('13:15:00')],
            ['place_id' => 1, 'time' => Carbon::parse('13:30:00')],
            ['place_id' => 1, 'time' => Carbon::parse('13:45:00')],
            ['place_id' => 1, 'time' => Carbon::parse('14:00:00')],
            ['place_id' => 1, 'time' => Carbon::parse('14:15:00')],
            ['place_id' => 1, 'time' => Carbon::parse('14:30:00')],
            ['place_id' => 1, 'time' => Carbon::parse('14:45:00')],
            ['place_id' => 1, 'time' => Carbon::parse('15:00:00')],
            ['place_id' => 1, 'time' => Carbon::parse('15:15:00')],
            ['place_id' => 1, 'time' => Carbon::parse('15:30:00')],
            ['place_id' => 1, 'time' => Carbon::parse('15:45:00')],

            ['place_id' => 2, 'time' => Carbon::parse('09:00:00')],
            ['place_id' => 2, 'time' => Carbon::parse('11:00:00')],
            ['place_id' => 2, 'time' => Carbon::parse('13:00:00')],
            ['place_id' => 2, 'time' => Carbon::parse('15:00:00')],

            ['place_id' => 3, 'time' => Carbon::parse('09:00:00')],
            ['place_id' => 3, 'time' => Carbon::parse('11:00:00')],
            ['place_id' => 3, 'time' => Carbon::parse('13:00:00')],
            ['place_id' => 3, 'time' => Carbon::parse('15:00:00')],
            ['place_id' => 3, 'time' => Carbon::parse('17:00:00')],
            ['place_id' => 3, 'time' => Carbon::parse('19:00:00')],
        ]);
    }
}
