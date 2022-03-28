<?php

namespace App\Http\Livewire\Order;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Checkout extends Component
{
    public $treatments;

    protected $listeners = ['timeChanged', 'treatmentAdded', 'treatmentDeleted'];

    public function timeChanged()
    {
        $this->render();
    }

    public function treatmentAdded()
    {
        $this->render();
    }

    public function treatmentDeleted()
    {
        $this->render();
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

    public function confirm()
    {
        // modal confirmasi
        $this->orderNow();
    }

    public function getNoReg()
    {
        $alphabet = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $phone = auth()->user()->phone;
        $i = rand(1,26);
        $j = rand(1,26);
        return $alphabet[$i] . $alphabet[$j] . $phone;
    }

    public function orderNow()
    {
        $order = Order::create([
            'place' => session('order.place'),
            'client_user_id' => auth()->id(),
            'midwife_user_id' => session('order.midwife_user_id'),
            'address_id' => 1,
            'total_price' => $this->total_price(),
            'total_duration' => $this->total_duration(),
            'total_transport' => $this->total_transport(),
            'date' => session('order.date'),
            'start_time' => $this->start_time(),
            'end_time' => $this->end_time(),
            'status' => Order::STATUS_LOCKED,
            'invoice' => 'INV/' . session('order.date')->isoFormat('YYYYMMDD') . '/BBC/' . rand(111111, 999999),
            'no_reg' => $this->getNoReg(),
        ]);

        foreach ( collect(session('order.treatments')) as $treatment ) {
            $order->treatments()->attach(
                $treatment['treatment_id']
            );
        }

        session()->forget('order');

        return redirect()->route('home');

    }

    public function total_price()
    {
        return $this->treatments->collapse()->sum('treatment_price');
    }

    public function total_transport()
    {
        if(session('order.kecamatan_distance') < 4) {
            return 40000;
        } else {
            return 40000 + ((session('order.kecamatan_distance') - 4) * 5000);
        }
    }

    public function total_duration()
    {
        return session('order.addMinutes');
    }

    public function start_time()
    {
        return DB::table('slots')->where('id', session('order.start_time_id'))->value('time');
    }

    public function end_time()
    {
        return Carbon::parse($this->start_time())->addMinutes($this->total_duration())->toTimeString();
    }

    public function render()
    {
        $this->treatments = collect(session('order.treatments')) ?? [];

        $this->treatments = $this->treatments->mapToGroups(function($item, $key) {
            return [$item['treatment_name'] => [
                'family_name' => $item['family_name'],
                'treatment_id' => $item['treatment_id'],
                'treatment_name' => $item['treatment_name'],
                'treatment_desc' => $item['treatment_desc'],
                'treatment_price' => $item['treatment_price'],
                'treatment_duration' => $item['treatment_duration'],
            ]];
        });

        $data['kecamatan'] = DB::table('kecamatans')->where('id', session('order.kecamatan_id'))->value('name');
        $data['bidan'] = \App\Models\User::where('id', session('order.midwife_user_id'))->value('name');
        $data['bidan_photo'] = \App\Models\User::where('id', session('order.midwife_user_id'))->first()->profile_photo_url;
        $data['date'] = session('order.date')->isoFormat('dddd, D MMMM G');
        $data['start_time'] = $this->start_time();
        $data['end_time'] = $this->end_time();
        $data['total_price'] = $this->total_price();
        $data['total_transport'] = $this->total_transport();
        $data['grand_total'] = $this->total_transport() + $this->total_price();

        return view('client.order.order-summary', [
            'data' => $data,
            'treatments' => $this->treatments,
        ]);
    }
}
