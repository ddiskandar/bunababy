<?php

namespace App\Http\Livewire\Client\Order;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Order;
use App\Models\Place;
use App\Models\Room;
use App\Models\User;

class CheckoutSummary extends Component
{
    public $place;
    public $room;

    public function mount()
    {
        $this->place = Place::find(session('order.place_id'));

        if (session('order.place_type') === Place::TYPE_CLINIC) {
            $this->room = Room::find(session('order.room_id'));
        }
    }

    public function render()
    {
        $treatments = collect(session('order.treatments')) ?? [];

        $treatments = $treatments->mapToGroups(function ($item, $key) {
            return [$item['treatment_name'] => [
                'family_name' => $item['family_name'],
                'treatment_id' => $item['treatment_id'],
                'treatment_name' => $item['treatment_name'],
                'treatment_desc' => $item['treatment_desc'],
                'treatment_price' => $item['treatment_price'],
                'treatment_duration' => $item['treatment_duration'],
            ]];
        });

        $order = new Order();

        if (session('order.place_type') === Place::TYPE_HOMECARE) {
            $midwife = User::where('id', session('order.midwife_user_id'))->first();
            $data['midwife'] = $midwife->name;
            $data['midwife_photo'] = $midwife->profile_photo_url;
            $data['kecamatan'] = DB::table('kecamatans')->where('id', session('order.kecamatan_id'))->value('name');
        }

        $data['date'] = tanggal(session('order.date'));
        $data['time'] = waktu($order->getStartTime()) . ' - ' . waktu($order->getEndTime()) . ' WIB ';
        $data['total_price'] = rupiah($order->getTotalPrice());
        $data['total_transport'] = rupiah($order->getTotalTransport());
        $data['grand_total'] = rupiah($order->getTotalTransport() + $order->getTotalPrice());

        return view('client.order.checkout-summary', [
            'data' => $data,
            'treatments' => $treatments,
        ]);
    }
}
