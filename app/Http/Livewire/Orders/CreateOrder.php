<?php

namespace App\Http\Livewire\Orders;

use App\Models\Address;
use App\Models\Kecamatan;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateOrder extends Component
{
    public $clientId;
    public $kecamatanId;
    public $midwifeId;
    public $date;
    public $orders;
    public $time;
    public $place = 1;

    public $kecamatan;
    public $client;
    public $showAllMidwives = false;

    public $rules = [];

    public function updatedClientId()
    {
        $this->client = User::find($this->clientId);
    }

    public function updatedDate()
    {
        $this->orders = Order::query()
            ->where('midwife_user_id', $this->midwifeId)
            ->where('date', $this->date)
            ->get();
    }

    public function save()
    {
        $addressId = Address::query()
            ->where('client_user_id', $this->clientId)
            ->where('kecamatan_id', $this->kecamatanId)
            ->value('id');

        $order = Order::create([
            'no_reg' => Str::random(10),
            'invoice' => Str::random(10),
            'place' => $this->place,
            'client_user_id' => $this->clientId,
            'midwife_user_id' => $this->midwifeId,
            'address_id' => $addressId,
            'total_price' => 0,
            'total_duration' => 0,
            'total_transport' => 0,
            'additional' => 0,
            'date' => $this->date,
            'start_time' => $this->time,
            'end_time' => $this->time,
        ]);

        return redirect()->route('orders.show', $order->id);
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
