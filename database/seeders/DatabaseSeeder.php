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

        // Order

        for( $i = 31; $i <= 50; $i++ ){

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

            $date = today()->subDays($i - 31);
            $midwifeId = rand(3,8);

            $order = Order::factory()
                ->create([
                    'id' => $i,
                    'place' => Order::PLACE_CLINIC,
                    'no_reg' => $date->isoFormat('YYMMDD') . Order::PLACE_CLINIC . $midwifeId . '0945',
                    'invoice' => 'INV/' . $date->isoFormat('YYMMDD'). '/BBC/' . Order::PLACE_CLINIC . $midwifeId . '0945',
                    'address_id' => $i,
                    'total_price' => 0,
                    'total_duration' => 0,
                    'total_transport' => 0,
                    'midwife_user_id' => $midwifeId,
                    'client_user_id' => $i,
                    'start_datetime' => Carbon::parse($date->toDateString() . ' ' . '09:45'),
                ]);

            $treatment1 = rand(1,21);

            $order->treatments()->attach([$treatment1]);

            $totalDuration = $order->total_duration + $order->treatments()->sum('duration');

            $order->update([
                'total_price' => $order->treatments()->sum('price'),
                'total_duration' =>  $totalDuration,
                'end_datetime' => $order->start_datetime->addMinutes($totalDuration),
            ]);

            $users = User::where('type', User::OWNER)->orWhere('type', User::ADMIN)->get();

            Notification::send($users,new NewOrder($order));

            $testimonial = Testimonial::factory()
                ->create([
                    'order_id' => $order->id,
                ]);

            $payment = Payment::factory()
                ->create([
                    'order_id' => $order->id,
                    'value' => $order->getGrandTotal(),
                    'status' => Payment::STATUS_VERIFIED
                ]);

            Notification::send($users, new NewPayment($payment));

        }

        for( $i = 51; $i <= 75; $i++ ){

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

            $date = today()->subDays($i);
            $midwifeId = rand(3,8);

            $order = Order::factory()
                ->create([
                    'id' => $i,
                    'place' => Order::PLACE_CLIENT,
                    'no_reg' => $date->isoFormat('YYMMDD') . Order::PLACE_CLIENT . $midwifeId . '0945',
                    'invoice' => 'INV/' . $date->isoFormat('YYMMDD'). '/BBC/' . Order::PLACE_CLIENT . $midwifeId . '0945',
                    'address_id' => $i,
                    'total_price' => 0,
                    'total_duration' => 40,
                    'total_transport' => 40000,
                    'midwife_user_id' => $midwifeId,
                    'client_user_id' => $i,
                    'start_datetime' => Carbon::parse($date->toDateString() . ' ' . '09:45'),
                ]);

            $treatment1 = rand(1,21);

            $order->treatments()->attach([$treatment1]);

            $totalDuration = $order->total_duration + $order->treatments()->sum('duration');

            $order->update([
                'total_price' => $order->treatments()->sum('price'),
                'total_duration' =>  $totalDuration,
                'end_datetime' => $order->start_datetime->addMinutes($totalDuration),
            ]);

            $users = User::where('type', User::OWNER)->orWhere('type', User::ADMIN)->get();

            Notification::send($users,new NewOrder($order));

            $testimonial = Testimonial::factory()
                ->create([
                    'order_id' => $order->id,
                ]);

            $payment = Payment::factory()
                ->create([
                    'order_id' => $order->id,
                    'value' => $order->getGrandTotal() / 2,
                ]);

            Notification::send($users, new NewPayment($payment));

        }



        // upcoming order

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

            $date = today()->addDays($i - 9);
            $midwifeId = rand(3,8);

            $order = Order::factory()
                ->create([
                    'id' => $i,
                    'place' => Order::PLACE_CLIENT,
                    'no_reg' => $date->isoFormat('YYMMDD') . Order::PLACE_CLIENT . $midwifeId . '0945',
                    'invoice' => 'INV/' . $date->isoFormat('YYMMDD'). '/BBC/' . Order::PLACE_CLIENT . $midwifeId . '0945',
                    'address_id' => $i,
                    'total_price' => 0,
                    'total_duration' => 40,
                    'total_transport' => 40000,
                    'midwife_user_id' => $midwifeId,
                    'client_user_id' => $i,
                    'start_datetime' => Carbon::parse($date->toDateString() . ' ' . '09:45'),
                ]);

            $treatment1 = rand(1,21);

            $order->treatments()->attach([$treatment1]);

            $totalDuration = $order->total_duration + $order->treatments()->sum('duration');

            $order->update([
                'total_price' => $order->treatments()->sum('price'),
                'total_duration' =>  $totalDuration,
                'end_datetime' => $order->start_datetime->addMinutes($totalDuration),
            ]);

            $users = User::where('type', User::OWNER)->orWhere('type', User::ADMIN)->get();

            Notification::send($users,new NewOrder($order));

            // $testimonial = Testimonial::factory()
            //     ->create([
            //         'order_id' => $order->id,
            //     ]);

            // $payment = Payment::factory()
            //     ->create([
            //         'order_id' => $order->id,
            //     ]);

        }
    }
}
