<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Family;
use App\Models\Order;
use App\Models\Place;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Filament\Notifications\Notification as FlashNotification;
use Livewire\Component;

class Confirm extends Component
{
    public $confirmed = false;

    public function confirm()
    {
        if ($this->clashCheck()) {
            Notification::make()
                ->title('Jadwal Reservasi Bentrok!')
                ->danger()->send();

            return back();
        }

        $this->orderNow();
    }

    private function clashCheck()
    {
        $startDateTime = Carbon::parse(Carbon::parse(session('order.date'))->toDateString() . ' ' . session('order.start_time'));

        $currentActiveOrders = Order::query()
            ->whereDate('date', session('order.date'))
            ->where('place_id', session('order.place_id'))
            ->when(session('order.place_type') === Place::TYPE_HOMECARE,
                fn ($query) => $query->where('midwife_user_id', session('order.midwife_user_id')),
                fn ($query) => $query->where('room_id', session('order.room_id'))
            )
            ->activeBetween(
                $startDateTime->toDateTimeString(),
                $startDateTime->addMinutes(
                    (int) session('order.addMinutes') + (int) session('order.place_transport_duration')
                )->toDateTimeString()
            );

        return $currentActiveOrders->exists();
    }

    private function orderNow()
    {
        DB::transaction(function () {

            $order = new Order();
            $order->place_id = session('order.place_id');
            $order->client_user_id = auth()->id();
            $order->total_price = $order->getTotalPrice();
            $order->total_duration = $order->getTotalDuration();
            $order->date = Carbon::parse(session('order.date')->toDateString());
            $order->start_time = Carbon::parse(session('order.start_time'))->toTimeString();
            $order->end_time = $order->startDateTime->addMinutes(session('order.addMinutes'))->toTimeString();
            $order->status = Order::STATUS_LOCKED;

            if (session('order.place_type') === Place::TYPE_HOMECARE) {
                $order->total_transport = $order->getTotalTransport();
                $order->midwife_user_id = session('order.midwife_user_id');
                $order->address_id = session('order.address_id');
            }

            if (session('order.place_type') === Place::TYPE_CLINIC) {
                $order->room_id = session('order.room_id');
            }

            $order->save();

            $families = collect(session('order.families'));

            foreach (collect(session('order.treatments')) as $treatment) {
                $client = $families->where('id', $treatment['family_id'])->first();

                if ($client['type'] === 'Diri Sendiri') {
                    $age = calculate_age(auth()->user()->profile->dob);
                } else {
                    $family = Family::find($treatment['family_id']);
                    $age = calculate_age($family->dob);
                }

                $order->treatments()->attach($treatment['treatment_id'], [
                    'family_name' => $treatment['family_name'],
                    'family_age' => $age,
                    'treatment_price' => $treatment['treatment_price'],
                    'treatment_duration' => $treatment['treatment_duration'],
                ]);
            }

            session()->forget('order');

            event(new \App\Events\NewOrderCreated($order));

            FlashNotification::make()
                ->title('Order created!')
                ->success()
                ->send();

            return redirect()->route('order.show', $order->id);
        });
    }

    public function render()
    {
        return view('client.order.confirm');
    }
}
