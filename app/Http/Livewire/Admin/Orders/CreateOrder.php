<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Kecamatan;
use App\Models\Order;
use App\Models\Place;
use App\Models\Room;
use App\Models\Slot;
use App\Models\Timetable;
use App\Models\User;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateOrder extends Component
{
    public $places;

    public $selectedPlace;
    public $selectedMidwife;
    public $selectedKecamatan;
    public $selectedClient;

    public $state = [];

    public $showAllMidwives = false;

    protected $listeners = [
        'timeChanged' => '$refresh',
        'clientSelected' => 'clientSelected',
    ];

    public function mount()
    {
        $this->places = Place::active()->orderAsc()->get();

        $this->state['startTime'] = null;
        $this->state['startTimeId'] = null;

        $this->setSelectedPlace();
    }

    public function setSelectedPlace()
    {
        $this->resetOnPlaceChange();

        if (! isset($this->state['placeId'])) {
            $this->state['placeId'] = 1;
        }
        $this->selectedPlace = Place::whereId($this->state['placeId'])->first();
        $this->setAddMinutes();
    }

    private function setAddMinutes()
    {
        $this->state['addMinutes'] = $this->selectedPlace->transport_duration;
    }

    private function resetOnPlaceChange()
    {
        session()->forget('order');
        $this->state['roomId'] = null;
        $this->state['startTime'] = null;
        $this->state['startTimeId'] = null;
        $this->selectedMidwife = null;
        $this->setAddMinutes();
    }

    public function clientSelected($id)
    {
        $this->selectedClient = User::whereId($id)->first();
    }

    public function setSelectedKecamatan()
    {
        $this->selectedKecamatan = Kecamatan::whereId($this->state['kecamatanId'])->first();
    }

    public function setSelectedMidwife()
    {
        $this->selectedMidwife = User::whereId($this->state['midwifeId'])->first();
    }

    public function updatedMidwife()
    {
        //
    }

    public function updatedDate()
    {
        //
    }

    public function updatedTime()
    {
        //
    }

    public function selectTime(Slot $slot)
    {
        $this->state['startTime'] = $slot->time;
        $this->state['startTimeId'] = $slot->id;

        $this->emit('timeChanged');
    }

    private function getCurrentExistsOrders()
    {
        $orders = Order::query()
            ->locked()
            ->when($this->selectedPlace->type === Place::TYPE_HOMECARE,
                fn ($query) => $query->where('midwife_user_id', $this->selectedMidwife->id)
            )->when($this->selectedPlace->type === Place::TYPE_CLINIC,
                fn ($query) => $query
                    ->where('place_id', $this->selectedPlace->id)
                    ->where('room_id', $this->state['roomId'])
            )->whereDate('start_datetime', $this->state['date'])
            ->where('midwife_user_id', $this->selectedMidwife->id)
            ->select('id', 'start_datetime', 'end_datetime')
            ->get();

        return $orders;
    }

    public function save()
    {
        $orders = $this->getCurrentExistsOrders();
        session()->put('order', [
            'place_id' => $this->selectedPlace->id,
            'place_type' => $this->selectedPlace->type,
            'place_transport_duration' => $this->selectedPlace->transport_duration,
            'room_id' => $this->state['roomId'] ?? null,
            'midwife_user_id' => $this->selectedMidwife->id,
            'start_time_id' => $this->state['startTimeId'],
            'start_time' => $this->state['startTime'],
            'date' => Carbon::parse($this->state['date']),
            'addMinutes' => $this->state['addMinutes'],
            'kecamatan_distance' => $this->selectedKecamatan->distance,
            'order.treatments' => [],
        ]);

        $startTime = Carbon::parse(Carbon::parse(session('order.date'))->toDateString() . ' ' . session('order.start_time'));

        foreach ($orders as $order) {
            if ($order->activeBetween(
                    $startTime,
                    $startTime->addMinutes(session('order.addMinutes') + session('order.place_transport_duration'))
                )->exists()
                ) {
                Notification::make()
                    ->title('Jadwal Reservasi Bentrok!')
                    ->danger()
                    ->send();

                return back();
            }
        }

        DB::transaction(function () {

            $order = new Order();
            $order->no_reg = $order->getNoReg();
            $order->invoice = $order->getInvoice();
            $order->place_id = session('order.place_id');
            $order->client_user_id = $this->selectedClient->id;
            $order->total_price = $order->getTotalPrice();
            $order->total_duration = $order->getTotalDuration();
            $order->start_datetime = Carbon::parse(session('order.date')->toDateString() . ' ' . session('order.start_time'));
            $order->end_datetime = $order->start_datetime->addMinutes(session('order.addMinutes'));
            $order->status = Order::STATUS_LOCKED;

            if (session('order.place_type') === Place::TYPE_HOMECARE) {
                $order->total_transport = $order->getTotalTransport();
                $order->midwife_user_id = session('order.midwife_user_id');
                $order->address_id = session('order.address_id');
            }

            if (session('order.place_type') === Place::TYPE_CLINIC) {
                $order->room_id = session('order.room_id');
            }

            $order->save();

            session()->forget('order');

            return to_route('orders.show', $order->id);
        });
    }

    public function render()
    {
        $orders = [];
        $data = [];
        $kecamatans = [];
        $rooms = [];

        if($this->selectedPlace && $this->selectedMidwife && isset($this->state['date'])) {
            $orders = $this->getCurrentExistsOrders();
            $data = collect();
            $slots = DB::table('slots')->where('place_id', $this->selectedPlace->id)->orderBy('time')->get();

            foreach ($slots as $slot) {
                $new = collect(['id' => $slot->id]);
                $new->put('time', $slot->time);
                foreach ($orders as $order) {
                    if (Carbon::parse($this->state['date'] . $slot->time)->between($order->start_datetime, $order->end_datetime)) {
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

        if($this->selectedClient) {
            $kecamatans = Kecamatan::active()
                ->whereIn('id', $this->selectedClient->addresses->pluck('kecamatan_id'))
                ->orderBy('name')
                ->get();
        }

        if($this->selectedPlace) {
            $rooms = Room::active()
                ->where('place_id', $this->selectedPlace->id)
                ->orderBy('name')
                ->get();
        }

        $timetable = [];

        if ($this->selectedPlace && isset($this->state['date'])){
            $timetable = Timetable::query()
                ->where('place_id', $this->selectedPlace->id)
                ->whereDate('date', Carbon::parse($this->state['date']))
                ->pluck('midwife_user_id');
        }

        $midwives = User::active()->midwives()
            ->when($this->selectedPlace->type === Place::TYPE_CLINIC && ! $this->showAllMidwives,
                fn ($query) => $query->whereIn('id', $timetable)
            )->with('profile')
            ->orderBy('name')
            ->get();

        return view('admin.orders.create-order', [
            'rooms' => $rooms,
            'kecamatans' => $kecamatans,
            'data' => $data,
            'midwives' => $midwives,
        ]);
    }
}
