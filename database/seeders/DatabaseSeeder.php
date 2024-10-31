<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Client;
use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            TreatmentSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            PlaceSeeder::class,
            SlotSeeder::class,
            TagSeeder::class,
            PriceSeeder::class,
            RoomSeeder::class,
            MidwifeSeeder::class,
        ]);

        User::factory()
            ->create([
                'name' => 'Owner',
                'email' => 'hr@bunababycare.com',
                'type' => UserType::OWNER,
            ]);

        Client::factory(30)->create();
    }
}
