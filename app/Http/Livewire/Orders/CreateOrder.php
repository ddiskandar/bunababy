<?php

namespace App\Http\Livewire\Orders;

use App\Models\Kecamatan;
use App\Models\Order;
use App\Models\Slot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateOrder extends Component
{
    public $clientId;
    public $kecamatanId;
    public $midwifeId;

    public $place;
    public $date;
    public $time;
    public $kecamatan;
    public $client;
    public $midwives;
    public $data;

    public $showAllMidwives = false;

    protected $listenes = [
        'timeChanged' => '$refresh',
    ];

    public function mount()
    {
        if(session()->missing('order.place')){
            session()->put('order.place', 1);
        }

        $this->place = session('order.place');

        if(session()->has('order.client_user_id')){
            $this->clientId = session('order.client_user_id');
            $this->client = User::find($this->clientId);
        }

        if(session()->has('order.kecamatan_id')){
            $this->kecamatanId = session('order.kecamatan_id');
        }

        if(session()->has('order.midwife_user_id')){
            $this->midwifeId = session('order.midwife_user_id');
        }

        if(session()->has('order.date')){
            $this->date = session('order.date')->toDateString();
        }

        if(session('order.place') == 1){
            $addMinutes = DB::table('options')->select('transport_duration')->first()->transport_duration;
            session()->put('order.addMinutes', $addMinutes);
        } else {
            session()->put('order.addMinutes', 0);
        }

        $this->clients = User::query()
            ->where('type', User::CLIENT)
            ->active()
            ->orderBy('name')
            ->get();

        $this->midwives = User::query()
            ->where('type', User::MIDWIFE)
            ->active()
            ->orderBy('name')
            ->get();

    }

    public function updatedPlace()
    {
        session()->put('order.place', $this->place);

        if(session('order.place') == 1){
            $addMinutes = DB::table('options')->select('transport_duration')->first()->transport_duration;
            session()->put('order.addMinutes', $addMinutes);
        } else {
            session()->put('order.addMinutes', 0);
        }
    }

    public function updatedClientId()
    {
        $this->client = User::find($this->clientId);
        session()->put('order.client_user_id', $this->clientId);
    }

    public function updatedKecamatanId()
    {
        $kecamatan = DB::table('kecamatans')->where('id', $this->kecamatanId )->first();

        session()->put('order.kecamatan_id', $kecamatan->id);
        session()->put('order.kecamatan_distance', $kecamatan->distance);
    }

    public function updatedMidwifeId()
    {
        session()->put('order.midwife_user_id', $this->midwifeId);
    }

    public function updatedDate()
    {
        session()->put('order.date', Carbon::parse($this->date));
        return to_route('orders.create');
    }

    public function updatedTime()
    {
        session()->put('order.start_time', $this->time);
    }

    public function selectTime(Slot $slot)
    {
        session()->put('order.start_time', $slot->time);
        session()->put('order.start_time_id', $slot->id);

        $this->emit('timeChanged');
    }

    public function save()
    {
        $orders = Order::query()
            ->where('midwife_user_id', session('order.midwife_user_id'))
            ->whereDate('start_datetime', session('order.date'))
            ->locked()
            ->get();

        $date = session('order.date')->toDateString();

        foreach($orders as $order) {
            if ($order->activeBetween($date . ' ' . session('order.start_time'), Carbon::parse($date . ' ' . session('order.start_time'))->addMinutes(session('order.addMinutes')))->exists()) {
                session()->flash('treatments', 'Tidak dapat membuat reservasi pada pilihan dan rentang waktu ini, silahkan pilih pada slot waktu yang kosong.');
                return back();
            }
        }

        DB::transaction(function () {

            $order = new Order();
            $order->no_reg = $order->getNoReg();
            $order->invoice = $order->getInvoice();
            $order->place = session('order.place');
            $order->client_user_id = session('order.client_user_id');
            $order->midwife_user_id = session('order.midwife_user_id') ?? NULL;
            $order->total_price = 0;
            $order->total_duration = session('order.addMinutes');
            $order->start_datetime = Carbon::parse(session('order.date')->toDateString() . ' ' . session('order.start_time'));
            $order->end_datetime = Carbon::parse(session('order.date')->toDateString() . ' ' . session('order.start_time'))->addMinutes(session('order.addMinutes'));
            $order->status = Order::STATUS_LOCKED;

            if(session('order.place') == 1){
                $order->total_transport = $order->getTotalTransport();
            }

            $order->save();

            session()->forget('order');

            return redirect()->route('orders.show', $order->id);
        });
    }

    public function render()
    {
        $orders = Order::query()
            ->where('midwife_user_id', session('order.midwife_user_id'))
            ->whereDate('start_datetime', session('order.date'))
            ->locked()
            ->select('id', 'start_datetime', 'end_datetime')
            ->get();

        $data = collect();

        $slots = DB::table('slots')->get();

        foreach ($slots as $slot) {
            $new = collect(['id' => $slot->id]);
            $new->put('time', $slot->time);
            foreach ($orders as $order) {
                if ( Carbon::parse(session('order.date')->toDateString().$slot->time)->between($order->start_datetime, $order->end_datetime)) {
                    $new->put($order->id, 'booked');
                } else { $new->put($order->id, 'empty'); }
            }
            $new->put('status', ($new->contains('booked')) ? 'booked' : 'empty');
            $new->put('slot', Carbon::parse($slot->time)->gte(Carbon::parse('12:00:00')) ? 'siang' : 'pagi');

            $data->push($new);
        }
        $this->data = $data->groupBy(function ($slot) {
            if ($slot['slot'] == 'pagi') {
                return 'pagi';
            }
            return 'siang';
        });

        $this->kecamatans = Kecamatan::query()
            ->active()
            ->orderBy('name')
            ->when($this->client, function ($query) {
                $query->whereIn('id', $this->client->addresses->pluck('kecamatan_id'));
            })
            ->get();

        return view('orders.create-order');
    }
}
