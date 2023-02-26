<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Category;
use App\Models\Treatment;
use Livewire\Component;

class SelectTreatments extends Component
{
    public $showAddTreatmentModal = false;

    public $family_id;

    public Treatment $currentTreatment;

    public function mount()
    {
        $this->currentTreatment = new Treatment();

        $this->family_id = time();

        if (auth()->check()) {

            if (auth()->user()->families()->exists()) {
                session()->put('order.families', auth()->user()->families->toArray());
                session()->push('order.families', [
                    'id' => time(),
                    'name' => auth()->user()->name,
                    'type' => 'Diri Sendiri'
                ]);
            } else {
                session()->put('order.families', [
                    [
                        'id' => time(),
                        'name' => auth()->user()->name,
                        'type' => 'Diri Sendiri'
                    ]
                ]);
            }
        }
    }

    protected $listeners = [
        'familySelected',
        'timeChanged' => '$refresh',
        'treatmentDeleted' => '$refresh',
    ];

    public function familySelected($familyId)
    {
        $this->showAddTreatmentModal = false;
        $this->family_id = $familyId;
        $this->addTreatment($this->currentTreatment);
    }

    public function confirmAddTreatment(Treatment $treatment)
    {
        $this->currentTreatment = $treatment;
        $this->showAddTreatmentModal = true;
    }

    public function addTreatment(Treatment $treatment)
    {

        if (session()->missing('order.addMinutes')) {
            session()->put('order.addMinutes', 40);
        }

        session()->increment('order.addMinutes', $treatment->duration);

        $family = collect(session('order.families'))->where('id', $this->family_id)->first();

        session()->push('order.treatments', [
            'treatment_id' => $treatment->id,
            'treatment_name' => $treatment->name,
            'treatment_desc' => $treatment->desc,
            'treatment_price' => $treatment->price,
            'treatment_duration' => $treatment->duration,
            'family_id' => $this->family_id,
            'family_name' => $family['name'],
        ]);

        $this->emit('treatmentAdded');
    }

    public function deleteTreatment($index, Treatment $treatment)
    {
        session()->forget('order.treatments.' . $index);
        session()->decrement('order.addMinutes', $treatment->duration);

        $this->emit('treatmentDeleted');
    }

    public function addFamily()
    {
        session()->push('order.families', [
            'id' => $this->family_id,
            'name' => 'pulan',
            'type' => 'buna',
        ]);
    }

    public function render()
    {
        $categories = Category::query()
            ->with('treatments', function ($query) {
                $query->whereActive(true)->orderBy('order', 'ASC');
            })
            ->orderBy('order', 'ASC')
            ->get();

        return view('client.order.select-treatments', [
            'categories' => $categories,
        ]);
    }
}
