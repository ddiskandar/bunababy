<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Treatment;
use Carbon\Carbon;
use Livewire\Component;

class SelectTreatments extends Component
{
    public $order;
    public $treatmentId;

    protected $listeners = [
        'saved' => '$refresh',
    ];

    protected $rules = [
        'treatmentId' => 'required|exists:treatments,id'
    ];

    protected $validationAttributes = [
        'treatmentId' => 'Treatment'
    ];

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function delete($id)
    {
        $this->order->treatments()->detach($id);

        $treatment = Treatment::find($id);

        $this->order->update([
            'total_duration' => $this->order->total_duration - $treatment->duration,
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

        foreach($orders as $order) {
            if ($order->activeBetween($this->order->start_datetime, $this->order->end_datetime->addMinutes($treatment->duration))->exists()) {
                session()->flash('treatments', 'Tidak dapat membuat reservasi pada pilihan dan rentang waktu ini, silahkan pilih pada slot waktu yang kosong.');
                return back();
            }
        }

        $this->order->treatments()->attach($this->treatmentId);

        $treatment = Treatment::find($this->treatmentId);
        $this->order->update([
            'total_duration' => $this->order->total_duration + $treatment->duration,
            'end_datetime' => $this->order->end_datetime->addMinutes($treatment->duration),
            'total_price' => $this->order->treatments()->sum('price'),
        ]);

        $this->treatmentId = '';
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

        return view('orders.select-treatments', [
            'treatments' => $treatments,
        ]);
    }
}
