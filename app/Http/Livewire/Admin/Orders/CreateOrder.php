<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Exceptions\NoSlotException;
use App\Models\Kecamatan;
use App\Models\Order;
use App\Models\Place;
use App\Models\Room;
use App\Models\Setting;
use App\Models\Slot;
use App\Models\Timetable;
use App\Models\User;
use Carbon\Carbon;
use Error;
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
        try {
            if (!isset($this->state['placeId'])) {
                $this->state['placeId'] = 1;
            }

            $this->selectedPlace = Place::whereId($this->state['placeId'])->first();

            $this->resetOnPlaceChange();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    private function resetOnPlaceChange()
    {
        session()->forget('order');
        $this->state['roomId'] = null;
        $this->state['startTime'] = null;
        $this->state['startTimeId'] = null;
        $this->state['addMinutes'] = $this->selectedPlace->transport_duration;
        $this->selectedMidwife = null;
    }

    public function updatedStateDate()
    {
        $this->state['startTime'] = null;
        $this->state['startTimeId'] = null;
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

    public function selectTime(Slot $slot)
    {
        $this->state['startTime'] = $slot->time;
        $this->state['startTimeId'] = $slot->id;

        $this->emit('timeChanged');
    }

    public function save()
    {
        try {
            session()->put('order', [
                'place_id' => $this->selectedPlace->id,
                'place_type' => $this->selectedPlace->type,
                'place_transport_duration' => $this->selectedPlace->transport_duration,
                'room_id' => $this->state['roomId'] ?? null,
                'midwife_user_id' => $this->selectedMidwife->id,
                'start_time_id' => $this->state['startTimeId'],
                'start_time' => $this->state['startTime'],
                'date' => Carbon::parse($this->state['date']),
                'addMinutes' => $this->selectedPlace->transport_duration,
                'kecamatan_distance' => $this->selectedKecamatan->distance,
                'order.treatments' => [],
            ]);

            if ($this->currentActiveOrders()->exists()) {
                throw new NoSlotException('Slot reservasi tersedia tidak cukup!');
            }

            DB::transaction(function () {

                $order = new Order();
                $order->place_id = session('order.place_id');
                $order->client_user_id = $this->selectedClient->id;
                $order->total_price = $order->getTotalPrice();
                $order->total_duration = $order->getTotalDuration();
                $order->date = session('order.date');
                $order->start_time = session('order.start_time');
                $order->end_time = session('order.start_time');
                $order->status = Order::STATUS_LOCKED;
                $order->midwife_user_id = session('order.midwife_user_id');

                if (session('order.place_type') === Place::TYPE_HOMECARE) {
                    $order->total_transport = $order->getTotalTransport();
                    $order->address_id = session('order.address_id');
                }

                if (session('order.place_type') === Place::TYPE_CLINIC) {
                    $order->room_id = session('order.room_id');
                }

                $order->save();

                session()->forget('order');

                return to_route('orders.show', $order->id);
            });

        } catch (NoSlotException $th) {
            Notification::make()->title($th->getMessage())->danger()->send();
        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    private function currentActiveOrders()
    {
        $startDateTime = Carbon::parse(
            Carbon::parse(session('order.date'))->toDateString() . ' ' . session('order.start_time')
        );

        return Order::query()
            ->where('place_id', session('order.place_id'))
            ->whereDate('date', session('order.date'))
            ->when(session('order.place_type') === Place::TYPE_HOMECARE,
                fn ($query) => $query->where('midwife_user_id', session('order.midwife_user_id')),
                fn ($query) => $query->where('room_id', session('order.room_id'))
            )
            ->activeBetween(
                $startDateTime->toTimeString(),
                $startDateTime->addMinutes(
                    (int) session('order.addMinutes')
                )->toTimeString()
            );
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
                ->get();

            $data = collect();
            $slots = DB::table('slots')->where('place_id', $this->selectedPlace->id)->orderBy('time')->get();

            foreach ($slots as $slot) {
                $new = collect(['id' => $slot->id]);
                $new->put('time', $slot->time);
                foreach ($orders as $order) {
                    if (Carbon::parse($this->state['date'] . $slot->time)
                        ->between(
                            $order->startDateTime,
                            $order->endDateTime->addMinutes($order->place->transport_duration)
                        )){
                        $new->put($order->id, 'booked');
                    } else {
                        $new->put($order->id, 'empty');
                    }
                }
                $new->put('status', ($new->contains('booked')) ? 'booked' : 'empty');
                $new->put('slot', ($slot->time > '12:00:00') ? 'siang' : 'pagi');

                $data->push($new);
            }

            $data = $data->groupBy(function ($slot) {
                if ($slot['slot'] === 'pagi') {
                    return 'pagi';
                }
                return 'siang';
            });
        }

        $kecamatans = [];

        if($this->selectedClient) {
            $kecamatans = Kecamatan::active()
                ->whereIn('id', $this->selectedClient->addresses->pluck('kecamatan_id'))
                ->orderBy('name')
                ->get();
        }

        $rooms = [];

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
