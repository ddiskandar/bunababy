<?php

namespace App\Http\Livewire\Orders;

use App\Models\Kecamatan;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class MidwifeTime extends Component
{
    public $state = [];

    public $order;

    protected $rules = [
        'state.client.name' => 'required',
        'state.midwife_user_id' => 'required',
        'state.start_time' => 'required',
        'state.end_time' => 'required',
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->state = $this->order->toArray();
        $this->state['date'] = $this->order->start_datetime->toDateString();
        $this->state['start_time'] = substr($this->order->start_datetime->toTimeString(), 0, 5);
    }

    public function save()
    {
        // TODO Cek bentrok
        $this->order->update([
            'midwife_user_id' => $this->state['midwife_user_id'],
            'start_datetime' => Carbon::parse( $this->state['date'] . ' ' . $this->state['start_time']),
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
