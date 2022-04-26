<?php

namespace App\Http\Livewire\Orders;

use App\Models\Kecamatan;
use App\Models\Order;
use App\Models\Treatment;
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
        $orders = Order::query()
            ->where('midwife_user_id', $this->order->midwife_user_id)
            ->whereDate('start_datetime', $this->order->start_datetime)
            ->locked()
            ->get()
            ->except($this->order->id);

        foreach($orders as $order) {
            if ($order->activeBetween($this->order->start_datetime, $this->order->start_datetime->addMinutes($this->order->total_duration))->exists()) {
                session()->flash('treatments', 'Tidak dapat membuat reservasi pada pilihan dan rentang waktu ini, silahkan pilih pada slot waktu yang kosong.');
                return back();
            }
        }

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
