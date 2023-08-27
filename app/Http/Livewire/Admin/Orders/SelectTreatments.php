<?php

namespace App\Http\Livewire\Admin\Orders;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Livewire\Component;
use Error;
use App\Models\Treatment;
use App\Models\Family;
use App\Models\Order;
use App\Models\Price;

class SelectTreatments extends Component
{
    use AuthorizesRequests;

    public $order;
    public $families;
    public $selectedFamily;
    public $state = [];

    protected $listeners = [
        'saved' => '$refresh',
    ];

    protected $rules = [
        'state.treatmentId' => 'required|exists:treatments,id',
        'state.familyId' => 'required',
    ];

    protected $validationAttributes = [
        'state.treatmentId' => 'Treatment',
        'state.familyId' => 'Client',
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

    public function setSelectedFamily()
    {
        $this->selectedFamily = $this->families->firstWhere('id', $this->state['familyId']);
    }

    public function delete($id)
    {
        try {
            $this->authorize('manage-orders');

            $this->order->treatments()->detach($id);

            $treatment = Treatment::find($id);

            $this->order->update([
                'total_duration' => $this->order->total_duration - $treatment->duration,
                'end_time' => $this->order->endDateTime->subMinutes($treatment->duration)->toTimeString(),
                'total_price' => $this->order->treatments()->sum('treatment_price'),
            ]);

            $this->refreshPage();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title('Whoops! Terjadi kesalahan.')->danger()->send();
        }
    }

    private function refreshPage()
    {
        return to_route('orders.show', $this->order->id);
    }

    public function save()
    {
        try {
            $this->authorize('manage-orders');

            if (!$this->order->midwife_user_id) {
               throw new Error('Bidan belum dipilih!');
            }

            $this->validate();

            $treatment = Treatment::where('id', $this->state['treatmentId'])->first();

            $currentActiveOrders = Order::query()
                ->whereDate('date', $this->order->startDateTime)
                ->where('midwife_user_id', $this->order->midwife_user_id)
                ->activeBetween(
                    $this->order->startDateTime->toTimeString(),
                    $this->order->endDateTime
                        ->addMinutes($this->order->place->transport_duration + $treatment->duration)
                        ->toTimeString()
                )
                ->get()
                ->except($this->order->id);

            if ($currentActiveOrders->count() > 0) {
                throw new Error('Slot waktu tersedia kurang!');
            }

            $this->order->treatments()->attach($this->state['treatmentId'], [
                'treatment_price' => Price::where('treatment_id', $this->state['treatmentId'])
                    ->where('place_id', $this->order->place_id)->value('amount'),

                'treatment_duration' => $treatment->duration,
                'family_name' => $this->selectedFamily['name'],
                'family_age' => $this->selectedFamily['age'],
            ]);

            $this->order->update([
                'total_duration' => $this->order->total_duration + $treatment->duration,
                'end_time' => $this->order->endDateTime->addMinutes($treatment->duration)->toTimeString(),
                'total_price' => $this->order->treatments()->sum('treatment_price'),
            ]);

            $this->state = [];
            $this->selectedFamily = [];

            $this->refreshPage();

        } catch (\Throwable $th) {
            Notification::make()->title($th->getMessage())->danger()->send();
        }
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
