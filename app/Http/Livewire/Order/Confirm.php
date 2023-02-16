<?php

namespace App\Http\Livewire\Order;

use App\Models\Family;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NewOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Confirm extends Component
{
    public function confirm()
    {
        $this->orderNow();
    }

    public function orderNow()
    {
        DB::transaction(function () {

            $order = new Order();
            $order->no_reg = $order->getNoReg();
            $order->invoice = $order->getInvoice();
            $order->place = session('order.place');
            $order->client_user_id = auth()->id();
            $order->total_price = $order->getTotalPrice();
            $order->total_duration = $order->getTotalDuration();
            $order->start_datetime = Carbon::parse(session('order.date')->toDateString() . ' ' . session('order.start_time'));
            $order->end_datetime = $order->start_datetime->addMinutes(session('order.addMinutes'));
            $order->status = Order::STATUS_LOCKED;

            if (session('order.place') == Order::PLACE_CLIENT) {
                $order->total_transport = $order->getTotalTransport();
                $order->midwife_user_id = session('order.midwife_user_id');
                $order->address_id = session('order.address_id');
            }

            $order->save();

            foreach (collect(session('order.treatments')) as $treatment) {
                $family = Family::find($treatment['family_id']);

                $order->treatments()->attach($treatment['treatment_id'], [
                    'family_name' => $treatment['family_name'],
                    'family_age' => calculate_age($family->dob),
                    'treatment_price' => $treatment['treatment_price'],
                    'treatment_duration' => $treatment['treatment_duration'],
                ]);
            }

            session()->forget('order');

            $admin = User::where('type', User::ADMIN)
                ->orWhere('type', User::OWNER)
                ->get();

            Notification::send($admin, new NewOrder($order));

            return redirect()->route('order.show', $order->no_reg);
        });
    }

    public function render()
    {
        return view('order.confirm');
    }
}
