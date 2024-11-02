<?php

namespace Database\Seeders;

use App\Enums\PaymentStatus;
use App\Enums\PlaceType;
use App\Enums\UserType;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Price;
use App\Models\Profile;
use App\Models\Treatment;
use App\Models\User;
use App\Support\DateTime;
use Carbon\Carbon;
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

        Customer::factory(30)
            ->has(Address::factory())
            ->create();

        // $this->command->info("Creating orders ...\n");

        // $bar = $this->command->getOutput()->createProgressBar(100);

        // $bar->start();

        // foreach (range(1, 100) as $i) {

        //     $customer = Customer::factory()->create();

        //     $tag = rand(1, 3);
        //     $customer->tags()->attach($tag);

        //     $address = Address::factory()
        //         ->create([
        //             'customer_id' => $customer->id,
        //             'label' => 'rumah',
        //             'is_main' => true,
        //             'kecamatan_id' => rand(1, 70),
        //         ]);

        //     $date = today()->addDays($i);
        //     $midwifeId = rand(1, 5);

        //     $order = Order::factory()
        //         ->create([
        //             'place_id' => PlaceType::HOMECARE,
        //             'address_id' => $address->id,
        //             'transport' => 0,
        //             'midwife_id' => $midwifeId,
        //             'customer_id' => $customer->id,
        //             'date' => Carbon::parse($date->toDateString()),
        //             'start_time' => Carbon::createFromTime(8, 0, 0)->toTimeString(),
        //         ]);

        //     // foreach (range(1, 2) as $index ) {
        //     //     $id = rand(1, 21);
        //     //     $order->treatments()->attach($id, [
        //     //         'family_name' => $order->customer->name,
        //     //         'family_age' => DateTime::calculateAge($order->customer->dob),
        //     //         'treatment_duration' => Treatment::find($id)->duration,
        //     //         'treatment_price' => Price::where('treatment_id', $id)
        //     //             ->where('place_id', $order->place_id)->value('amount'),
        //     //     ]);
        //     // }

        //     // $totalDuration = $order->total_duration + $order->treatments->sum('duration');

        //     // $order->update([
        //     //     'total_price' => $order->treatments->sum('pivot.treatment_price'),
        //     //     'total_duration' =>  $totalDuration,
        //     //     'end_time' => $order->startDateTime->addMinutes($totalDuration)->toTimeString(),
        //     // ]);

        //     $payment = Payment::factory()
        //         ->create([
        //             'order_id' => $order->id,
        //             'value' => $order->getGrandTotal(),
        //             'status' => PaymentStatus::VERIFIED
        //         ]);

        //     $bar->advance();
        // }

        // $bar->finish();
    }
}
