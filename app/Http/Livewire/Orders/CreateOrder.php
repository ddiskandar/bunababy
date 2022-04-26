<?php

namespace App\Http\Livewire\Orders;

use App\Models\Kecamatan;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateOrder extends Component
{
    public $place;
    public $clientId;
    public $kecamatanId;
    public $midwifeId;
    public $date;
    public $time;

    public $orders;

    public $kecamatan;
    public $client;
    public $showAllMidwives = false;

    protected $rules = [
        'time' => 'required',
    ];

    protected $validationAttributes = [
        'time' => 'Waktu mulai'
    ];

    public function mount()
    {
        if (session()->missing('order.place')) {
            session()->put('order.place', 1);
        }

        $addMinutes = DB::table('options')->select('transport_duration')->first()->transport_duration;
        session()->put('order.addMinutes', $addMinutes);

        $this->place = session('order.place') ;
    }

    public function updatedPlace()
    {
        session()->put('order.place', $this->place);
    }

    public function updatedClientId()
    {
        $this->client = User::find($this->clientId);
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

        $this->orders = Order::query()
            ->where('midwife_user_id', $this->midwifeId)
            ->whereDate('start_datetime', $this->date)
            ->get();
    }

    public function updatedTime()
    {
        session()->put('order.start_time', $this->time);
    }

    public function save()
    {
        $this->validate();

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
            $order->client_user_id = $this->clientId;
            $order->midwife_user_id = session('order.midwife_user_id');
            $order->total_price = 0;
            $order->total_duration = session('order.addMinutes');
            $order->total_transport = $order->getTotalTransport();
            $order->start_datetime = Carbon::parse(session('order.date')->toDateString() . ' ' . session('order.start_time'));
            $order->end_datetime = Carbon::parse(session('order.date')->toDateString() . ' ' . session('order.start_time'))->addMinutes(session('order.addMinutes'));
            $order->status = Order::STATUS_LOCKED;
            $order->save();

            session()->forget('order');

            return redirect()->route('orders.show', $order->id);
        });
    }

    public function render()
    {
        $clients = User::query()
            ->active()
            ->orderBy('name')
            ->where('type', User::CLIENT)
            ->get();

        $midwives = User::query()
            ->active()
            ->orderBy('name')
            ->where('type', User::MIDWIFE)
            ->get();

        $kecamatans = Kecamatan::query()
            ->active()
            ->orderBy('name')
            ->when($this->client, function ($query) {
                $query->whereIn('id', $this->client->addresses->pluck('kecamatan_id'));
            })
            ->get();

        return view('orders.create-order', [
            'clients' => $clients,
            'midwives' => $midwives,
            'kecamatans' => $kecamatans,
        ]);
    }
}
