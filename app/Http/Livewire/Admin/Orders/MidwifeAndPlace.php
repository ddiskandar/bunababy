<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Address;
use App\Models\Kecamatan;
use App\Models\Order;
use App\Models\Place;
use App\Models\Room;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MidwifeAndPlace extends Component
{
    public $places;
    public $order;

    public $selectedPlace;
    public $selectedMidwife;
    public $selectedClient;

    public $state = [];

    public $showAllMidwives = false;

    public $showDialog = false;
    public $dialogEditMode = false;

    protected $rules = [
        'state.label' => 'required|string|min:3|max:32',
        'state.address' => 'required|string|min:3|max:255',
        'state.desa' => 'required|string|min:2|max:32',
        'state.note' => 'nullable|string|min:2|max:255',
        'state.share_location' => 'nullable|string|min:2|max:512',
        'state.kecamatan_id' => 'required|exists:kecamatans,id',
        'state.midwifeId' => 'required|exists:users,id',
    ];

    protected $validationAttributes = [
        'state.label' => 'Label alamat',
        'state.address' => 'Kampung/Jalan',
        'state.desa' => 'Desa',
        'state.kecamatan_id' => 'Kecamatan',
        'state.note' => 'Catatan',
        'state.share_location' => 'Google Maps',
        'state.midwifeId' => 'Bidan',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(Order $order)
    {
        $this->places = Place::active()->orderAsc()->get();
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
        $this->resetOnPlaceChange();
        $this->selectedPlace = Place::whereId($this->state['placeId'])->first();
        if ($this->order->place_id !== $this->selectedPlace->id) {
            if ($this->order->place->type === Place::TYPE_HOMECARE && $this->selectedPlace->type === Place::TYPE_CLINIC){
                $this->state['totalDuration'] = $this->order->total_duration - $this->selectedPlace->transport_duration;
                $this->state['totalTransport'] = 0;
            }

            if ($this->order->place->type === Place::TYPE_CLINIC && $this->selectedPlace->type === Place::TYPE_HOMECARE){
                $this->state['totalDuration'] = $this->order->total_duration + $this->selectedPlace->transport_duration;
            }
        }
    }

    private function resetOnPlaceChange()
    {
        $this->state['roomId'] = null;
        $this->state['addressId'] = null;
        $this->state['totalTransport'] = $this->order->total_transport;
    }

    public function setSelectedMidwife()
    {
        $this->selectedMidwife = User::whereId($this->state['midwifeId'])->first();
    }

    public function setSelectedAddress($addressId)
    {
        $this->state['addressId'] = (int) $addressId;
        $address = Address::whereId($this->state['addressId'])->first(); // TODO : refactor relationship
        $kecamatan = Kecamatan::whereId($address->kecamatan_id)->first();
        $this->state['totalTransport'] = calculate_transport($kecamatan->distance);
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

    private function getCurrentExistsOrders()
    {
        $currentActiveOrders =  Order::query()
            ->whereDate('start_datetime', $this->order->start_datetime)
            ->where('midwife_user_id', $this->selectedMidwife->id)
            ->when($this->selectedPlace->type === Place::TYPE_CLINIC,
                fn ($query) => $query
                    ->where('place_id', $this->state['placeId'])
                    ->where('room_id', $this->state['roomId'])
            )
            ->activeBetween(
                $this->order->start_datetime->toDateTimeString(),
                $this->order->end_datetime
                    ->addMinutes($this->order->place->transport_duration)
                    ->toDateTimeString()
            )
            ->get()
            ->except($this->order->id);

        return $currentActiveOrders;
    }

    public function update()
    {
        $orders = $this->getCurrentExistsOrders();

        if ($orders->count() > 0) {
            Notification::make()
                ->title('Slot waktu tersedia kurang!')
                ->danger()->send();

            return back();
        }

        $this->order->update([
            'midwife_user_id' => $this->state['midwifeId'],
            'place_id' => $this->state['placeId'],
            'address_id' => $this->state['addressId'],
        ]);

        if ($this->selectedPlace->type === Place::TYPE_CLINIC){
            $this->order->update([
                'room_id' => $this->state['roomId'],
            ]);
        }

        if ($this->order->place_id !== $this->selectedPlace->id){
            $this->order->update([
                'total_duration' => $this->state['totalDuration'],
                'total_transport' => $this->state['totalTransport'],
                'end_datetime' => $this->order->start_datetime->addMinutes($this->state['totalDuration']),
            ]);
        }

        $this->emit('saved');
    }

    public function render()
    {
        $midwives = User::active()->midwives()->orderBy('name')->get();

        $addresses = Address::where('client_user_id', $this->selectedClient->id)->get();

        $rooms = [];
        if ($this->selectedPlace) {
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
