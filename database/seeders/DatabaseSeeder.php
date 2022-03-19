<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OptionSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            SlotSeeder::class,
            CategorySeeder::class,
            TreatmentSeeder::class,
        ]);

        $bidan1 = \App\Models\User::factory()->create([
            'name' => 'Bidan Febri',
            'type' => User::MIDWIFE,
        ]);

        $bidan1->kecamatans()->attach([2]);

        $bidan2 = \App\Models\User::factory()->create([
            'name' => 'Bidan Lina',
            'type' => User::MIDWIFE,
        ]);

        $bidan2->kecamatans()->attach([52, 53, 46, 36, 34, 56, 48, 63, 10, 8, 5, 13, 12, 28]);

        $bidan3 = \App\Models\User::factory()->create([
            'name' => 'Bidan Dinda',
            'type' => User::MIDWIFE,
        ]);

        $bidan3->kecamatans()->attach([19, 29, 30, 21, 73, 76, 71, 18, 4, 2, 3]);

        $bidan4 = \App\Models\User::factory()->create([
            'name' => 'Bidan Ririn',
            'type' => User::MIDWIFE,
        ]);

        $bidan4->kecamatans()->attach([15, 16, 43, 21, 80, 31, 24, 28, 13, 14, 11, 23, 6, 7, 25]);

        $bidan5 = \App\Models\User::factory()->create([
            'name' => 'Bidan Ina',
            'type' => User::MIDWIFE,
        ]);

        $bidan5->kecamatans()->attach([3, 2, 1, 74, 75, 64, 29, 30, 18, 4, 10]);

        $bidan6 = \App\Models\User::factory()->create([
            'name' => 'Bidan Suci',
            'type' => User::MIDWIFE,
        ]);

        $bidan6->kecamatans()->attach([16, 11, 23, 14, 27, 6, 7, 25, 20, 22, 26, 17, 32, 40, 43]);

    }
}
