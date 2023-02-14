<?php

namespace App\Http\Livewire\Orders;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MidwifeAndPlace extends Component
{
    public $order;
    public $client;
    public $selectedAddressId;
    public $place;
    public $midwifeId;

    public $state = [];

    public $showDialog = false;
    public $dialogEditMode = false;

    protected $rules = [
        'state.label' => 'required|string|min:3|max:32',
        'state.address' => 'required|string|min:3|max:255',
        'state.desa' => 'required|string|min:2|max:32',
        'state.note' => 'nullable|string|min:2|max:255',
        'state.share_location' => 'nullable|string|min:2|max:512',
        'state.kecamatan_id' => 'required|exists:kecamatans,id',
    ];

    protected $validationAttributes = [
        'state.label' => 'Label alamat',
        'state.address' => 'Kampung/Jalan',
        'state.desa' => 'Desa',
        'state.kecamatan_id' => 'Kecamatan',
        'state.note' => 'Catatan',
        'state.share_location' => 'Google Maps',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->client = $order->client;
        $this->place = $order->place;
        $this->midwifeId = $order->midwife_user_id;
        $this->selectedAddressId = $order->address_id;
    }

    public function updatedMidwifeId()
    {
        if ($this->midwifeId == NULL) {
            return back();
        }

        $this->order->update([
            'midwife_user_id' => $this->midwifeId,
        ]);

        $this->emit('saved');
    }

    public function updatedPlace()
    {
        $this->order->update([
            'address_id' => NULL,
            'place' => $this->place,
        ]);

        $duration = DB::table('options')->first()->transport_duration;

        if ($this->place == Order::PLACE_CLINIC) {
            $this->order->update([
                'total_transport' => 0,
                'total_duration' => 0,
                'end_datetime' => $this->order->end_datetime->subMinutes($duration),
            ]);
        }

        if ($this->place == Order::PLACE_CLIENT) {
            $this->order->update([
                'total_duration' => $duration,
                'end_datetime' => $this->order->end_datetime->addMinutes($duration),
            ]);
        }

        $this->emit('saved');
    }

    public function updatedSelectedAddressId()
    {
        $this->order->update([
            'address_id' => $this->selectedAddressId,
        ]);

        // TRANSPORT ALGO

        if ($this->place == Order::PLACE_CLINIC) {
            return 0;
        }

        if ($this->order->address->kecamatan->distance < 4) {
            $transport = 40000;
        } else {
            $transport = 40000 + (session('order.kecamatan_distance') * 5000);
        }

        $this->order->update([
            'total_transport' => $transport,
        ]);

        $this->emit('saved');
    }

    public function showEditDialog(Address $address)
    {
        $this->state = $address->toArray();
        $this->showDialog = true;
        $this->dialogEditMode = true;
    }

    public function addNewAddress()
    {
        $this->state = [];
        $this->showDialog = true;
        $this->dialogEditMode = false;
    }

    public function save()
    {
        $this->validate();

        Address::updateOrCreate(
            [
                'id' => $this->state['id'] ?? time(),
                'client_user_id' => $this->client->id,
                'kecamatan_id' => $this->state['kecamatan_id'],
            ],
            [
                'label' => $this->state['label'],
                'address' => $this->state['address'],
                'desa' => $this->state['desa'],
                'note' => $this->state['note'] ?? '',
                'share_location' => $this->state['share_location'] ?? '',
            ]
        );

        $this->emit('saved');
        $this->showDialog = false;
    }

    public function render()
    {
        $midwives = User::query()
            ->active()
            ->orderBy('name')
            ->where('type', User::MIDWIFE)
            ->get();

        $addresses = Address::query()
            ->where('client_user_id', $this->client->id)
            ->get();

        return view('orders.midwife-and-place', [
            'midwives' => $midwives,
            'addresses' => $addresses,
        ]);
    }
}
