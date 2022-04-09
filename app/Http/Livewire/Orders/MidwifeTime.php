<?php

namespace App\Http\Livewire\Orders;

use App\Models\Kecamatan;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class MidwifeTime extends Component
{
    public $state = [];

    public $order;
    public $date;

    protected $rules = [
        'state.client.name' => 'required',
        'state.midwife_user_id' => 'required',
        'state.start_time' => 'required',
        'state.end_time' => 'required',
        'date' => 'required',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->state = $order->toArray();
        $this->date = $order->date->toDateString();

        // dd($this->order->date);
    }

    public function save()
    {
        // TODO Cek bentrok

        $this->order->update([
            'midwife_user_id' => $this->state['midwife_user_id'],
            'start_time' => $this->state['start_time'],
            'date' => $this->date,
        ]);

        $this->emit('saved');
    }

    public function render()
    {
        $midwives = User::query()
            ->active()
            ->orderBy('name')
            ->where('type', User::MIDWIFE)
            ->get();

        $kecamatans = Kecamatan::query()
            ->active()
            ->orderBy('name')
            ->get();

        return view('orders.midwife-time', [
            'midwives' => $midwives,
            'kecamatans' => $kecamatans,
        ]);
    }
}
