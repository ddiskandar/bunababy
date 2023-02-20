<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Family;
use App\Models\Order;
use App\Models\Treatment;
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
        $order->load('treatments');
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
            'total_price' => $this->order->treatments()->sum('price'),
        ]);

        $this->emit('saved');
    }

    public function save()
    {
        $this->validate();

        // TODO Cek bentrok
        $treatment = Treatment::find($this->treatmentId);

        $orders = Order::query()
            ->where('midwife_user_id', $this->order->midwife_user_id)
            ->whereDate('start_datetime', $this->order->start_datetime)
            ->locked()
            ->get()
            ->except($this->order->id);

        foreach ($orders as $order) {
            if ($order->activeBetween($this->order->start_datetime, $this->order->end_datetime->addMinutes($treatment->duration))->exists()) {
                session()->flash('treatments', 'Tidak dapat membuat reservasi pada pilihan dan rentang waktu ini, silahkan pilih pada slot waktu yang kosong.');
                return back();
            }
        }

        $treatment = Treatment::find($this->treatmentId);

        $this->order->treatments()->attach($this->treatmentId, [
            'treatment_price' => $treatment->price,
            'treatment_duration' => $treatment->duration,
            'family_name' => $this->selectedFamily['name'],
            'family_age' => $this->selectedFamily['age'],
        ]);

        $this->order->update([
            'total_duration' => $this->order->total_duration + $treatment->duration,
            'start_datetime' => $this->order->start_datetime,
            'end_datetime' => $this->order->end_datetime->addMinutes($treatment->duration),
            'total_price' => $this->order->treatments()->sum('price'),
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
