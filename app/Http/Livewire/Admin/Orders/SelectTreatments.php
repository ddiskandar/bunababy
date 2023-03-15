<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Family;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Place;
use App\Models\Price;
use App\Models\Treatment;
use Filament\Notifications\Notification;
use Illuminate\Support\Arr;
use Livewire\Component;

class SelectTreatments extends Component
{
    public $order;
    public $treatmentId;
    public $familyId;
    public $families;
    public $selectedFamily;

    protected $listeners = [
        'saved' => '$refresh',
    ];

    protected $rules = [
        'treatmentId' => 'required|exists:treatments,id',
        'familyId' => 'required',
    ];

    protected $validationAttributes = [
        'treatmentId' => 'Treatment',
        'familyId' => 'Client',
    ];

    public function mount(Order $order)
    {
        $order->load('treatments', 'place', 'client');
        $this->order = $order;

        $families = Family::query()
            ->where('client_user_id', $this->order->client_user_id)
            ->orderBy('name')
            ->get()
            ->toArray();

        $families[] = [
            'id' => $this->order->client->id,
            'name' => $this->order->client->name,
            'age' => $this->order->client->age ?? null,
            'type' => 'Client'
        ];

        $this->families = collect($families);
    }

    public function updatedFamilyId()
    {
        $this->selectedFamily = $this->families->firstWhere('id', $this->familyId);
    }

    public function delete($id)
    {
        $this->order->treatments()->detach($id);

        $treatment = Treatment::find($id);

        $this->order->update([
            'total_duration' => $this->order->total_duration - $treatment->duration,
            'start_datetime' => $this->order->start_datetime,
            'end_datetime' => $this->order->end_datetime->subMinutes($treatment->duration),
            'total_price' => $this->order->treatments()->sum('treatment_price'),
        ]);

        $this->emit('saved');
    }

    private function getCurrentExistsOrders()
    {
        return Order::locked()
            ->when($this->order->place->type === Place::TYPE_HOMECARE,
                fn ($query) => $query->where('midwife_user_id', $this->order->midwife->id)
            )->when($this->order->place->type === Place::TYPE_CLINIC,
                fn ($query) => $query
                    ->where('place_id', $this->order->place_id)
                    ->where('room_id', $this->order->room_id)
            )->whereDate('start_datetime', $this->order->start_datetime)
            ->where('midwife_user_id', $this->order->midwife_user_id)
            ->select('id', 'start_datetime', 'end_datetime')
            ->get()
            ->except($this->order->id);
    }

    public function save()
    {
        $this->validate();
        $treatment = Treatment::find($this->treatmentId);

        // TODO : Check if the time slot is available
        // $orders = $this->getCurrentExistsOrders();

        // foreach ($orders as $order) {
        //     $addMinutes = (int) $treatment->duration + (int) $this->order->place->transport_duration;

        //     if ($order->activeBetween(
        //             $this->order->start_datetime,
        //             $this->order->end_datetime
        //                 ->addMinutes($addMinutes)
        //         )
        //         ->exists()) {

        //         Notification::make()
        //             ->title('Slot waktu tersedia kurang!')
        //             ->danger()
        //             ->send();

        //         return back();
        //     }
        // }

        $this->order->treatments()->attach($this->treatmentId, [
            'treatment_price' => Price::where('treatment_id', $this->treatmentId)
                ->where('place_id', $this->order->place_id)->value('amount'),

            'treatment_duration' => $treatment->duration,
            'family_name' => $this->selectedFamily['name'],
            'family_age' => $this->selectedFamily['age'],
        ]);

        $this->order->update([
            'total_duration' => $this->order->total_duration + $treatment->duration,
            'start_datetime' => $this->order->start_datetime,
            'end_datetime' => $this->order->end_datetime->addMinutes($treatment->duration),
            'total_price' => $this->order->treatments()->sum('treatment_price'),
        ]);

        $this->treatmentId = '';
        $this->familyId = '';
        $this->selectedFamily = [];
        $this->emit('saved');
    }

    public function render()
    {
        $treatments = Treatment::query()
            ->select(['treatments.*', 'categories.name as category_name'])
            ->join('categories', 'treatments.category_id', '=', 'categories.id')
            ->orderBy('categories.order')
            ->orderBy('treatments.name')
            ->get();

        return view('admin.orders.select-treatments', [
            'treatments' => $treatments,
        ]);
    }
}
