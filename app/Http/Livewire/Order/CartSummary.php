<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CartSummary extends Component
{
    protected $listeners = [
        'timeChanged' => '$refresh',
        'treatmentAdded' => '$refresh',
        'treatmentDeleted' => '$refresh',
        'newUser'
    ];

    public function newUser()
    {
        session()->put('order.status', 'newUser');
        return redirect()->route('order.cart');
    }

    public function deleteTreatments($id)
    {
        $treatments = collect(session('order.treatments'))->where('treatment_id', $id);

        foreach ($treatments as $key => $treatment) {
            session()->forget('order.treatments.' . $key );
            session()->decrement('order.addMinutes', $treatment['treatment_duration']);
        }

        $this->emit('treatmentDeleted');
    }

    public function checkout()
    {
        if( session()->missing('order.start_time')){
            session()->flash('treatments', 'Belum ada slot yang dipilih, silahkan anda mulai reservasi dengan memilih waktu mulai treatment');
            return back();
        }

        if( session()->has('order.treatments') AND count(session('order.treatments')) <= 0) {
            session()->flash('treatments', 'Belum ada treatment yang dipilih, silahkan anda pilih terlebih dahulu');
            return back();
        }

        $orders = Order::query()
            ->where('midwife_user_id', session('order.midwife_user_id'))
            ->locked()
            ->whereDate('start_datetime', session('order.date'))
            ->get();

        $date = session('order.date')->toDateString();

        foreach($orders as $order) {
            if ($order->activeBetween($date . ' ' . $order->getStartTime(), $date . ' ' . $order->getEndTime())->exists()) {
                session()->flash('treatments', 'Tidak dapat membuat reservasi pada pilihan dan rentang waktu ini, silahkan pilih slot waktu yang kosong.');
                return back();
            }
        }

        return to_route('order.checkout');
    }

    public function render()
    {
        $treatments = collect(session('order.treatments')) ?? [];

        $treatments = $treatments->mapToGroups(function($item, $key) {
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
        $bidan = \App\Models\User::where('id', session('order.midwife_user_id'))->first();

        $data['kecamatan'] = DB::table('kecamatans')->where('id', session('order.kecamatan_id'))->value('name');
        $data['bidan'] = $bidan->name;
        $data['bidan_photo'] = $bidan->profile_photo_url;
        $data['date'] = tanggal(session('order.date'));
        $data['time'] = waktu($order->getStartTime()) . ' - ' . waktu($order->getEndTime()) . ' WIB ';
        $data['total_price'] = rupiah($order->getTotalPrice());
        $data['total_transport'] = rupiah($order->getTotalTransport());
        $data['grand_total'] = rupiah($order->getTotalTransport() + $order->getTotalPrice());

        return view('order.cart-summary', [
            'data' => $data,
            'treatments' => $treatments,
        ]);
    }
}
