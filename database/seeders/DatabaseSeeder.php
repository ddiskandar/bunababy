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
            'email' => 'bunababy.care@gmail.com',
            'type' => User::ADMIN,
        ]);

        $midwife1 = \App\Models\User::factory()
        ->has(Profile::factory())
        ->create([
            'name' => 'Bidan Febri',
            'type' => User::MIDWIFE,
        ]);

        $midwife1->kecamatans()->attach([2]);

        $midwife2 = \App\Models\User::factory()
        ->has(Profile::factory())
        ->create([
            'name' => 'Bidan Lina',
            'type' => User::MIDWIFE,
        ]);

        $midwife2->kecamatans()->attach([52, 53, 46, 36, 34, 56, 48, 63, 10, 8, 5, 13, 12, 28]);

        $midwife3 = \App\Models\User::factory()
        ->has(Profile::factory())
        ->create([
            'name' => 'Bidan Dinda',
            'type' => User::MIDWIFE,
        ]);

        $midwife3->kecamatans()->attach([19, 29, 30, 21, 73, 76, 71, 18, 4, 2, 3]);

        $midwife4 = \App\Models\User::factory()
        ->has(Profile::factory())
        ->create([
            'name' => 'Bidan Ririn',
            'type' => User::MIDWIFE,
        ]);

        $midwife4->kecamatans()->attach([15, 16, 43, 21, 80, 31, 24, 28, 13, 14, 11, 23, 6, 7, 25]);

        $midwife5 = \App\Models\User::factory()
        ->has(Profile::factory())
        ->create([
            'name' => 'Bidan Ina',
            'type' => User::MIDWIFE,
        ]);

        $midwife5->kecamatans()->attach([3, 2, 1, 74, 75, 64, 29, 30, 18, 4, 10]);

        $midwife6 = \App\Models\User::factory()
        ->has(Profile::factory())
        ->create([
            'name' => 'Bidan Suci',
            'type' => User::MIDWIFE,
        ]);

        $midwife6->kecamatans()->attach([16, 11, 23, 14, 27, 6, 7, 25, 20, 22, 26, 17, 32, 40, 43]);

        for( $i = 9; $i <= 30; $i++ ){

            $client = User::factory()->hasProfile()->create([
                'id' => $i
            ]);

            $tag = rand(1,3);
            $client->tags()->attach($tag);

            $address = Address::factory()
                ->create([
                    'id' => $i,
                    'client_user_id' => $i,
                    'label' => 'rumah',
                    'is_main' => true,
                    'kecamatan_id' => rand(1,70),
                ]);

            $order = Order::factory()
                ->create([
                    'id' => $i,
                    'no_reg' => 'A' . rand(3,8) . str_replace('-', '', today()->addDays($i)->toDateString()) . rand(11,99),
                    'address_id' => $i,
                    'midwife_user_id' => rand(3,8),
                    'client_user_id' => $i,
                    'start_datetime' => now()->addDays($i),
                    'end_datetime' => now()->addDays($i),
                ]);

            $treatment1 = rand(1,10);
            $treatment2 = rand(11,21);

            $order->treatments()->attach([$treatment1, $treatment2]);

            $order->update([
                'total_price' => $order->treatments()->sum('price'),
                'total_duration' => $order->treatments()->sum('duration')
            ]);

            $testimonial = Testimonial::factory()
                ->create([
                    'order_id' => $order->id,
                ]);

            // $payment = Payment::factory()
            //     ->create([
            //         'order_id' => $order->id,
            //     ]);

            // $owner->notify( new NewOrder($order));
            // $owner->notify( new NewPayment($payment));

        }
    }
}
