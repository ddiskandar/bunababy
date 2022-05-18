<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Testimonial;
use App\Models\User;
use App\Notifications\NewOrder;
use App\Notifications\NewPayment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Notification;

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
            TagSeeder::class,
        ]);

        $owner = User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Owner',
                'email' => 'owner@bunababy.com',
                'type' => User::OWNER,
        ]);

        $admin = User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Admin',
                'email' => 'admin@bunababy.com',
                'type' => User::ADMIN,
            ]);

        $midwife1 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Febri',
                'email' => 'bidan1@bunababy.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife1->kecamatans()->attach([2]);

        $midwife2 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Lina',
                'email' => 'bidan2@bunababy.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife2->kecamatans()->attach([52, 53, 46, 36, 34, 56, 48, 63, 10, 8, 5, 13, 12, 28]);

        $midwife3 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Dinda',
                'email' => 'bidan3@bunababy.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife3->kecamatans()->attach([19, 29, 30, 21, 73, 76, 71, 18, 4, 2, 3]);

        $midwife4 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Ririn',
                'email' => 'bidan4@bunababy.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife4->kecamatans()->attach([15, 16, 43, 21, 80, 31, 24, 28, 13, 14, 11, 23, 6, 7, 25]);

        $midwife5 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Ina',
                'email' => 'bidan5@bunababy.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife5->kecamatans()->attach([3, 2, 1, 74, 75, 64, 29, 30, 18, 4, 10]);

        $midwife6 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Suci',
                'email' => 'bidan6@bunababy.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife6->kecamatans()->attach([16, 11, 23, 14, 27, 6, 7, 25, 20, 22, 26, 17, 32, 40, 43]);


    }
}
