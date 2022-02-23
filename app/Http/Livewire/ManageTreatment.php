<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Treatment;
use Livewire\Component;

class ManageTreatment extends Component
{
    public $showAddTreatmentModal = false;

    public $family_id;

    public Treatment $currentTreatment;

    protected $listeners = [
        'familySelected',
        'timeChanged',
        'treatmentDeleted',
    ];

    public function mount()
    {
        $this->currentTreatment = new Treatment();

        $this->family_id = time();
    }

    public function familySelected($familyId)
    {
        $this->showAddTreatmentModal = false;
        $this->family_id = $familyId;
        $this->addTreatment($this->currentTreatment);
    }

    public function timeChanged()
    {
        $this->render();
    }

    public function treatmentDeleted()
    {
        $this->render();
    }

    public function confirmAddTreatment(Treatment $treatment)
    {
        $this->currentTreatment = $treatment;
        $this->showAddTreatmentModal = true;
    }

    public function addTreatment(Treatment $treatment) {

        if(session()->missing('order.addMinutes')) {
            session()->put('order.addMinutes', 40);
        }

        session()->increment('order.addMinutes', $treatment->duration);

        $family = collect(session('order.family'))->where('id',$this->family_id)->first();

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
        session()->forget('order.treatments.' . $index );
        session()->decrement('order.addMinutes', $treatment->duration);

        $this->emit('treatmentDeleted');
    }

    public function addFamily()
    {
        session()->push('order.families', [
            'id' => $this->family_id,
            'name' => 'pulan',
            'type'=> 'buna',
        ]);
    }

    public function render()
    {
        $categories = Category::query()
            ->with('treatments', function($query){
                $query->whereHidden(false);
            })->get();

        $data = collect();

        return view('livewire.manage-treatment', [
            'categories' => $categories,
        ]);
    }
}
