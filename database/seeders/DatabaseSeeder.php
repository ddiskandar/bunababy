<?php

namespace Database\Seeders;

use App\Events\NewOrderCreated;
use App\Events\NewPaymentCreated;
use App\Models\Address;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Place;
use App\Models\Price;
use App\Models\Profile;
use App\Models\Testimonial;
use App\Models\Treatment;
use App\Models\User;
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
            CategorySeeder::class,
            TreatmentSeeder::class,
            OptionSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            PlaceSeeder::class,
            SlotSeeder::class,
            TagSeeder::class,
            PriceSeeder::class,
            RoomSeeder::class,
        ]);

        User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Owner',
                'email' => 'hr@bunababycare.com',
                'type' => User::OWNER,
            ]);

        $admin1 = User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Admin 1',
                'email' => 'admin1@bunababycare.com',
                'type' => User::ADMIN,
            ]);

        $admin2 = User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Admin 2',
                'email' => 'admin2@bunababycare.com',
                'type' => User::ADMIN,
            ]);

        $midwife1 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Febri',
                'email' => 'bidan1@bunababycare.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife1->kecamatans()->attach([2]);
        $midwife1->treatments()->attach([
            1, 2, 3, 4,
            5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
            15, 16, 17, 18, 19, 20, 21
        ]);

        $midwife2 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Lina',
                'email' => 'bidan2@bunababycare.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife2->kecamatans()->attach([52, 53, 46, 36, 34, 56, 48, 63, 10, 8, 5, 13, 12, 28]);
        $midwife2->treatments()->attach([
            1, 2, 3, 4,
            // 5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
            15, 16, 17, 18, 19, 20, 21
        ]);

        $midwife3 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Dinda',
                'email' => 'bidan3@bunababycare.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife3->kecamatans()->attach([19, 29, 30, 21, 73, 76, 71, 18, 4, 2, 3]);
        $midwife3->treatments()->attach([
            // 1, 2, 3, 4,
            5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
            15, 16, 17, 18, 19, 20, 21
        ]);

        $midwife4 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Ririn',
                'email' => 'bidan4@bunababycare.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife4->kecamatans()->attach([15, 16, 43, 21, 80, 31, 24, 28, 13, 14, 11, 23, 6, 7, 25]);
        $midwife4->treatments()->attach([
            1, 2, 3, 4,
            5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
            // 15, 16, 17, 18, 19, 20, 21
        ]);

        $midwife5 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Ina',
                'email' => 'bidan5@bunababycare.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife5->kecamatans()->attach([3, 2, 1, 74, 75, 64, 29, 30, 18, 4, 10]);
        $midwife5->treatments()->attach([
            1, 2, 3, 4,
            // 5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
            15, 16, 17, 18, 19, 20, 21
        ]);

        $midwife6 = \App\Models\User::factory()
            ->has(Profile::factory())
            ->create([
                'name' => 'Bidan Suci',
                'email' => 'bidan6@bunababycare.com',
                'type' => User::MIDWIFE,
            ]);

        $midwife6->kecamatans()->attach([16, 11, 23, 14, 27, 6, 7, 25, 20, 22, 26, 17, 32, 40, 43]);
        $midwife6->treatments()->attach([
            // 1, 2, 3, 4,
            5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
            15, 16, 17, 18, 19, 20, 21
        ]);

        $this->command->info("Creating orders ...\n");

        $bar = $this->command->getOutput()->createProgressBar(100);

        $bar->start();

        foreach (range(1, 100) as $i) {

            $client = User::factory()->hasProfile()->create();

            $tag = rand(1, 3);
            $client->tags()->attach($tag);

            $address = Address::factory()
                ->create([
                    'client_user_id' => $client->id,
                    'label' => 'rumah',
                    'is_main' => true,
                    'kecamatan_id' => rand(1, 70),
                ]);

            $date = today()->addDays($i);
            $midwifeId = rand(4, 9);

            $order = Order::factory()
                ->create([
                    'place_id' => Place::TYPE_HOMECARE,
                    'address_id' => $address->id,
                    'total_price' => 0,
                    'total_duration' => 0,
                    'total_transport' => 0,
                    'midwife_user_id' => $midwifeId,
                    'client_user_id' => $client->id,
                    'date' => Carbon::parse($date->toDateString()),
                    'start_time' => Carbon::createFromTime(8, 0, 0)->toTimeString(),
                ]);

            foreach (range(1, 2) as $index ) {
                $id = rand(1, 21);
                $order->treatments()->attach($id, [
                    'family_name' => $order->client->name,
                    'family_age' => calculate_age($order->client->profile->dob),
                    'treatment_duration' => Treatment::find($id)->duration,
                    'treatment_price' => Price::where('treatment_id', $id)
                        ->where('place_id', $order->place_id)->value('amount'),
                ]);
            }

            $totalDuration = $order->total_duration + $order->treatments()->sum('duration');

            $order->update([
                'total_price' => $order->treatments->sum('pivot.treatment_price'),
                'total_duration' =>  $totalDuration,
                'end_time' => $order->startDateTime->addMinutes($totalDuration)->toTimeString(),
            ]);

            $payment = Payment::factory()
                ->create([
                    'order_id' => $order->id,
                    'value' => $order->getGrandTotal(),
                    'status' => Payment::STATUS_VERIFIED
                ]);

            Testimonial::factory()
                ->create([
                    'order_id' => $order->id,
                ]);

            event(new NewOrderCreated($order));
            event(new NewPaymentCreated($payment));

            $bar->advance();
        }

        $bar->finish();
    }
}
