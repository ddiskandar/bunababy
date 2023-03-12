<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Address;
use App\Models\Kecamatan;
use App\Models\Option;
use App\Models\Order;
use App\Models\Place;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MidwifeAndPlace extends Component
{
    public $places;
    public $order;
    public $option;

    public $selectedPlace;
    public $selectedMidwife;
    public $selectedClient;

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
        $this->places = Place::active()->orderAsc()->get();
        $this->option = Option::first();
        $order->load('place');
        $this->order = $order;

        $this->selectedClient = User::whereId($order->client_user_id)->first();

        $this->state['placeId'] = $order->place_id;
        $this->setSelectedPlace();
        $this->state['midwifeId'] = $order->midwife_user_id;
        $this->setSelectedMidwife();

        $this->state['roomId'] = $order->room_id;
        $this->state['addressId'] = (int) $order->address_id;

        $this->state['totalDuration'] = $order->total_duration;
        $this->state['totalTransport'] = $order->total_transport;
    }

    public function setSelectedPlace()
    {
        if($this->order->place_id !== $this->state['placeId']) {
            if($this->order->place->type === Place::TYPE_HOMECARE && $this->selectedPlace->type !== Place::TYPE_CLINIC){
                $this->state['totalDuration'] = $this->order->total_duration - $this->option->transport_duration;
                $this->state['totalTransport'] = 0;
            }

            if($this->order->place->type === Place::TYPE_CLINIC && $this->selectedPlace->type !== Place::TYPE_HOMECARE){
                $this->state['totalDuration'] = $this->order->total_duration + $this->option->transport_duration;
            }
        }
        $this->resetOnPlaceChange();
        $this->selectedPlace = Place::whereId($this->state['placeId'])->first();
    }

    private function resetOnPlaceChange()
    {
        $this->state['roomId'] = null;
        $this->state['addressId'] = null;
    }

    public function setSelectedMidwife()
    {
        $this->selectedMidwife = User::whereId($this->state['midwifeId'])->first();
    }

    public function setSelectedAddress($addressId)
    {
        $this->state['addressId'] = (int) $addressId;
        $address = Address::whereId($this->state['addressId'])->first();
        $kecamatan = Kecamatan::whereId($address->kecamatan_id)->first();
        $this->state['totalTransport'] = calculate_transport($kecamatan->distance);
        $this->emit('saved');
    }

    public function showEditDialog(Address $address)
    {
        $this->resetErrorBag();
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
                'client_user_id' => $this->selectedClient->id,
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

    public function update()
    {
        $this->order->update([
            'midwife_user_id' => $this->state['midwifeId'],
            'place_id' => $this->state['placeId'],
            'address_id' => $this->state['addressId'],
        ]);

        if($this->selectedPlace->type === Place::TYPE_CLINIC){
            $this->order->update([
                'room_id' => $this->state['roomId'],
            ]);
        }

        if($this->order->place_id !== $this->selectedPlace->id){
            $this->order->update([
                'total_duration' => $this->state['totalDuration'],
                'total_transport' => $this->state['totalTransport'],
                // 'start_datetime' => null,
                // 'end_datetime' => null,
            ]);
        }

        $this->emit('saved');
    }

    public function render()
    {
        $rooms = [];
        $midwives = User::active()->midwives()
            ->orderBy('name')
            ->get();

        $addresses = Address::query()
            ->where('client_user_id', $this->selectedClient->id)
            ->get();

        if($this->selectedPlace) {
            $rooms = Room::active()
                ->where('place_id', $this->selectedPlace->id)
                ->orderBy('name')
                ->get();
        }

        return view('admin.orders.midwife-and-place', [
            'midwives' => $midwives,
            'addresses' => $addresses,
            'kecamatans' => DB::table('kecamatans')->orderBy('name')->get(['id', 'name']),
            'rooms' => $rooms,
        ]);
    }
}
