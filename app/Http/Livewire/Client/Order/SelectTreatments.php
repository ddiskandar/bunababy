<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Category;
use App\Models\Place;
use App\Models\Room;
use App\Models\Treatment;
use App\Models\User;
use Livewire\Component;

class SelectTreatments extends Component
{
    public $showAddTreatmentModal = false;
    public $family_id;
    public $currentTreatment;

    public function mount()
    {
        session()->forget('order.treatments');
        session()->forget('order.start_time');
        session()->forget('order.start_time_id');
        session()->put('order.addMinutes', 0);

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
        $this->addTreatment();
    }

    public function confirmAddTreatment(Treatment $treatment)
    {
        $treatment->load([
            'prices' => function ($query) {
                $query->where('place_id', session('order.place_id'));
            }
        ]);
        $this->currentTreatment = $treatment->toArray();
        $this->showAddTreatmentModal = true;
    }

    public function addTreatment()
    {

        if (session()->missing('order.addMinutes')) {
            session()->put('order.addMinutes', 0);
        }

        session()->increment('order.addMinutes', $this->currentTreatment['duration']);

        $family = collect(session('order.families'))->where('id', $this->family_id)->first();

        session()->push('order.treatments', [
            'treatment_id' => $this->currentTreatment['id'],
            'treatment_name' => $this->currentTreatment['name'],
            'treatment_desc' => $this->currentTreatment['desc'],
            'treatment_price' => $this->currentTreatment['prices'][0]['amount'],
            'treatment_duration' => $this->currentTreatment['duration'],
            'family_id' => $this->family_id,
            'family_name' => $family['name'],
        ]);

        $this->emit('treatmentAdded');
    }

    public function deleteTreatment($index, $treatmentId)
    {
        $treatment = Treatment::find($treatmentId);

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

        $availableTreatments = collect();

        if (session('order.place_type') === Place::TYPE_HOMECARE) {
            $midwife = User::find(session('order.midwife_user_id'));
            throw_if(is_null($midwife), \Exception::class, 'Midwife not found');

            $availableTreatments = $midwife->treatments()->whereActive(true)
                ->orderBy('order', 'ASC')
                ->with(['category' => function ($query) {
                    $query->orderBy('order', 'ASC');
                }, 'prices' => function ($query) {
                    $query->where('place_id', session('order.place_id'));
                }])
                ->get()
                ->groupBy('category.name');
        }

        if (session('order.place_type') === Place::TYPE_CLINIC) {
            $availableTreatments = [];

            $room = Room::find(session('order.room_id'));
            throw_if(is_null($room), \Exception::class, 'room not found');

            $availableTreatments = $room->treatments()->whereActive(true)
                ->orderBy('order', 'ASC')
                ->with(['category' => function ($query) {
                    $query->orderBy('order', 'ASC');
                }, 'prices' => function ($query) {
                    $query->where('place_id', session('order.place_id'));
                }])
                ->get()
                ->groupBy('category.name');
        }

        $categories = [];

        if (isset($availableTreatments)) {
            $categories = $availableTreatments->map(function ($item, $key) {
                return [
                    'name' => $key,
                    'treatments' => $item->toArray(),
                ];
            });
        }

        // dd($availableTreatments);

        return view('client.order.select-treatments', [
            'categories' => $categories,
        ]);
    }
}
