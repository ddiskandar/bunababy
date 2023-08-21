<?php

namespace App\Http\Livewire\Admin\Orders;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Error;
use Carbon\Carbon;
use App\Models\Kecamatan;
use App\Models\Address;
use App\Models\Order;
use App\Models\Place;
use App\Models\Room;
use App\Models\Slot;
use App\Models\User;

class EditOrder extends Component
{
    public $places;
    public $order;

    public $selectedPlace;
    public $selectedMidwife;
    public $selectedAddress;
    public $selectedClient;

    public $state = [];

    public $showAllMidwives = false;

    public $showDialog = false;
    public $dialogEditMode = false;

    protected $rules = [
        'state.address.label' => 'required|string|min:3|max:32',
        'state.address.address' => 'required|string|min:3|max:255',
        'state.address.desa' => 'required|string|min:2|max:32',
        'state.address.note' => 'nullable|string|min:2|max:255',
        'state.address.share_location' => 'nullable|string|min:2|max:512',
        'state.address.kecamatan_id' => 'required|exists:kecamatans,id',
        'state.midwifeId' => 'required|exists:users,id',
    ];

    protected $validationAttributes = [
        'state.address.label' => 'Label alamat',
        'state.address.address' => 'Kampung/Jalan',
        'state.address.desa' => 'Desa',
        'state.address.kecamatan_id' => 'Kecamatan',
        'state.address.note' => 'Catatan',
        'state.address.share_location' => 'Google Maps',
        'state.midwifeId' => 'Bidan',
    ];

    protected $listeners = [
        'timeChanged' => '$refresh',
        'saved' => '$refresh'
    ];

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
        $this->setSelectedAddress($this->state['addressId']);

        $this->state['date'] = $order->startDateTime->toDateString();
        $this->state['startTime'] = $order->startDateTime->toTimeString();
        $this->state['startTimeId'] = DB::table('slots')
            ->where('place_id', $order->place_id)
            ->where('time', $order->startDateTime->toTimeString())
            ->first()->id;

        $this->state['totalDuration'] = $order->total_duration;
        $this->state['totalTransport'] = $order->total_transport;
    }

    public function setSelectedPlace()
    {
        $this->resetOnPlaceChange();
        $this->selectedPlace = Place::whereId($this->state['placeId'])->first();
        if ($this->order->place_id !== $this->selectedPlace->id) {
            if ( $this->order->place->type === Place::TYPE_HOMECARE
                && $this->selectedPlace->type === Place::TYPE_CLINIC ){
                $this->state['totalDuration'] = $this->order->total_duration - $this->selectedPlace->transport_duration;
                $this->state['totalTransport'] = 0;
            }

            if ( $this->order->place->type === Place::TYPE_CLINIC
                && $this->selectedPlace->type === Place::TYPE_HOMECARE ){
                $this->state['totalDuration'] = $this->order->total_duration + $this->selectedPlace->transport_duration;
            }
        }
    }

    private function resetOnPlaceChange()
    {
        $this->state['roomId'] = null;
        $this->state['addressId'] = null;
        $this->state['startTime'] = null;
        $this->state['startTimeId'] = null;
        $this->state['totalTransport'] = $this->order->total_transport;
    }

    public function setSelectedMidwife()
    {
        $this->selectedMidwife = User::whereId($this->state['midwifeId'])->first();
    }

    public function setSelectedAddress($addressId)
    {
        // TODO : refactor relationship
        $this->selectedAddress = Address::whereId($addressId)->first();

        $kecamatanDistance = 0;
        if ($this->selectedAddress){
            $kecamatanDistance = Kecamatan::whereId($this->selectedAddress->kecamatan_id)->first()->distance;
        }

        $this->state['totalTransport'] = calculateTransport($kecamatanDistance);
        $this->state['addressId'] = (int) $addressId;
    }

    public function showEditDialog(Address $address)
    {
        $this->resetErrorBag();
        $this->state['address'] = $address->toArray();
        $this->showDialog = true;
        $this->dialogEditMode = true;
    }

    public function addNewAddress()
    {
        $this->state['address'] = [];
        $this->showDialog = true;
        $this->dialogEditMode = false;
    }

    public function selectTime(Slot $slot)
    {
        $this->state['startTime'] = $slot->time;
        $this->state['startTimeId'] = $slot->id;

        $this->emit('timeChanged');
    }

    public function save()
    {
        $this->validate();

        Address::updateOrCreate(
            [
                'id' => $this->state['address']['id'] ?? time(),
                'client_user_id' => $this->selectedClient->id,
                'kecamatan_id' => $this->state['address']['kecamatan_id'],
            ],
            [
                'label' => $this->state['address']['label'],
                'address' => $this->state['address']['address'],
                'desa' => $this->state['address']['desa'],
                'note' => $this->state['address']['note'] ?? null,
                'share_location' => $this->state['address']['share_location'] ?? null,
            ]
        );

        $this->emit('saved');
        $this->showDialog = false;
    }

    private function getCurrentExistsOrders()
    {
        return Order::query()
            ->whereDate('date', $this->order->date)
            ->where('midwife_user_id', $this->selectedMidwife->id)
            ->when($this->selectedPlace->type === Place::TYPE_CLINIC,
                fn ($query) => $query
                    ->where('place_id', $this->state['placeId'])
                    ->where('room_id', $this->state['roomId'])
            )
            ->activeBetween(
                $this->order->startDateTime->toDateTimeString(),
                $this->order->endDateTime
                    ->addMinutes($this->order->place->transport_duration)
                    ->toDateTimeString()
            )
            ->get()
            ->except($this->order->id);
    }

    private function hasErrorMessage()
    {
        $errorMessage = '';

        if ($this->selectedPlace->type === Place::TYPE_HOMECARE && ! isset($this->state['addressId'])){
            $errorMessage = 'Alamat belum dipilih!';
        }

        if ($this->selectedPlace->type === Place::TYPE_CLINIC && ! isset($this->state['roomId'])){
            $errorMessage = 'Ruangan belum dipilih!';
        }

        if (! isset($this->state['startTime'])){
            $errorMessage = 'Waktu mulai belum dipilih!';
        }

        return $errorMessage;
    }

    public function update()
    {
        try {
            $errorMessage = $this->hasErrorMessage();

            if ($errorMessage !== ''){
                throw new Error($errorMessage);
            }

            $orders = $this->getCurrentExistsOrders();

            if ($orders->count() > 0) {
                throw new Error('Slot waktu tersedia kurang!');
            }

            $this->order->update([
                'midwife_user_id' => $this->state['midwifeId'],
                'place_id' => $this->state['placeId'],
                'date' => $this->state['date'],
                'start_time' => $this->state['startTime'],
                'end_time' => Carbon::parse($this->state['startTime'])
                    ->addMinutes($this->order->total_duration)
                    ->toTimeString(),
                'address_id' => $this->state['addressId'],
                'room_id' => $this->state['roomId'],
            ]);

            if ($this->order->place_id !== $this->selectedPlace->id){
                $this->order->update([
                    'total_transport' => $this->state['totalTransport'],
                ]);
            }

            $this->emit('saved');

        } catch (\Throwable $th) {
            Notification::make()->title($th->getMessage())->danger()->send();
        }
    }

    public function render()
    {
        $data = [];

        if($this->selectedPlace && $this->selectedMidwife && isset($this->state['date'])) {
            $orders = Order::locked()
                ->where('place_id', $this->selectedPlace->id)
                ->whereDate('date', $this->state['date'])
                ->when($this->selectedPlace->type === Place::TYPE_HOMECARE,
                    fn ($query) => $query->where('midwife_user_id', $this->selectedMidwife->id),
                    fn ($query) => $query->where('room_id', $this->state['roomId'])
                )
                ->with('place')
                ->get()
                ->except($this->order->id);

            $data = collect();
            $slots = DB::table('slots')->where('place_id', $this->selectedPlace->id)->orderBy('time')->get();

            foreach ($slots as $slot) {
                $new = collect(['id' => $slot->id]);
                $new->put('time', $slot->time);
                foreach ($orders as $order) {
                    if (Carbon::parse($this->state['date'] . $slot->time)
                        ->between($order->startDateTime, $order->endDateTime
                        ->addMinutes($order->place->transport_duration))) {
                        $new->put($order->id, 'booked');
                    } else {
                        $new->put($order->id, 'empty');
                    }
                }
                $new->put('status', ($new->contains('booked')) ? 'booked' : 'empty');
                $new->put('slot', Carbon::parse($slot->time)->gte(Carbon::parse('12:00:00')) ? 'siang' : 'pagi');

                $data->push($new);
            }

            $data = $data->groupBy(function ($slot) {
                if ($slot['slot'] === 'pagi') {
                    return 'pagi';
                }
                return 'siang';
            });
        }

        $midwives = User::active()->midwives()->orderBy('name')->get();

        $addresses = Address::where('client_user_id', $this->selectedClient->id)->get();

        $rooms = [];
        if ($this->selectedPlace) {
            $rooms = Room::active()
                ->where('place_id', $this->selectedPlace->id)
                ->orderBy('name')
                ->get();
        }

        return view('admin.orders.edit-order', [
            'midwives' => $midwives,
            'addresses' => $addresses,
            'kecamatans' => DB::table('kecamatans')->orderBy('name')->get(['id', 'name']),
            'rooms' => $rooms,
            'data' => $data,
        ]);
    }
}
