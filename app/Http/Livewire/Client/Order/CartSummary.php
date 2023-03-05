<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Option;
use App\Models\Order;
use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CartSummary extends Component
{
    public $showDialog = false;

    protected $listeners = [
        'timeChanged' => '$refresh',
        'treatmentAdded' => '$refresh',
        'treatmentDeleted' => '$refresh',
        'newUser'
    ];

    public function deleteTreatments($id)
    {
        $treatments = collect(session('order.treatments'))->where('treatment_id', $id);

        foreach ($treatments as $key => $treatment) {
            session()->forget('order.treatments.' . $key);
            session()->decrement('order.addMinutes', $treatment['treatment_duration']);
        }

        $this->emit('treatmentDeleted');
    }

    public function checkout()
    {
        if (session()->missing('order.start_time')) {
            session()->flash('treatments', 'Belum ada slot yang dipilih, silahkan anda mulai reservasi dengan memilih waktu mulai treatment');
            return back();
        }

        if (session()->has('order.treatments') and count(session('order.treatments')) <= 0) {
            session()->flash('treatments', 'Belum ada treatment yang dipilih, silahkan anda pilih terlebih dahulu');
            return back();
        }

        $options = Option::first();

        $orders = Order::query()
            ->when(session('order.place_type') === Place::TYPE_HOMECARE, function ($query) {
                return $query->where('midwife_user_id', session('order.midwife_user_id'));
            })
            ->when(session('order.place_type') === Place::TYPE_CLINIC, function ($query) {
                return $query->where('room_id', session('order.room_id'));
            })
            ->locked()
            ->whereDate('start_datetime', session('order.date'))
            ->get();

        $date = session('order.date')->toDateString();

        foreach ($orders as $order) {
            // TODO : Cek bentrok
            if ($order->activeBetween($date . ' ' . $order->getStartTime(), $date . ' ' . Carbon::parse($order->getEndTime())->addMinutes($options->transport_duration))->exists()) {
                session()->flash('treatments', 'Tidak dapat membuat reservasi pada pilihan dan rentang waktu ini, silahkan pilih slot waktu yang kosong.');
                return back();
            }
        }

        return to_route('order.checkout');
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
            $bidan = \App\Models\User::where('id', session('order.midwife_user_id'))->first();
            $data['bidan'] = $bidan->name;
            $data['bidan_photo'] = $bidan->profile_photo_url;
            $data['kecamatan'] = DB::table('kecamatans')->where('id', session('order.kecamatan_id'))->value('name');
        }

        $data['date'] = tanggal(session('order.date'));
        $data['time'] = waktu($order->getStartTime()) . ' - ' . waktu($order->getEndTime()) . ' WIB ';
        $data['total_price'] = rupiah($order->getTotalPrice());
        $data['total_transport'] = rupiah($order->getTotalTransport());
        $data['grand_total'] = session()->has('order.treatments') && session('order.treatments') !== []
            ? rupiah($order->getTotalTransport() + $order->getTotalPrice())
            : rupiah(0);

        return view('client.order.cart-summary', [
            'data' => $data,
            'treatments' => $treatments,
        ]);
    }
}
