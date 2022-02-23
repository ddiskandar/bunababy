<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderSummary extends Component
{
    protected $listeners = ['timeChanged', 'treatmentAdded', 'treatmentDeleted'];

    public function mount()
    {

    }

    public function timeChanged()
    {
        $this->render();
    }

    public function treatmentAdded()
    {
        $this->render();
    }

    public function treatmentDeleted()
    {
        $this->render();
    }

    public function deleteTreatments($id)
    {
        $treatments = collect(session('order.treatments'))->where('treatment_id', $id);

        foreach ($treatments as $key => $treatment) {
            session()->forget('order.treatments.' . $key );
            session()->decrement('order.addMinutes', $treatment['treatment_duration']);
        }

        $this->emit('treatmentDeleted');
    }

    public function render()
    {
        $treatments = collect(session('order.treatments')) ?? [];

        $treatments = $treatments->mapToGroups(function($item, $key) {
            return [$item['treatment_name'] => [
                'family_name' => $item['family_name'],
                'treatment_id' => $item['treatment_id'],
                'treatment_name' => $item['treatment_name'],
                'treatment_desc' => $item['treatment_desc'],
                'treatment_price' => $item['treatment_price'],
                'treatment_duration' => $item['treatment_duration'],
            ]];
        });

        // dd($treatments);

        $data['kecamatan'] = DB::table('kecamatans')->where('id', session('order.kecamatan_id'))->value('name');
        $data['bidan'] = \App\Models\User::where('id', session('order.midwife_user_id'))->value('name');
        $data['date'] = session('order.date')->isoFormat('dddd, D MMMM G');
        $data['start_time'] = DB::table('slots')->where('id', session('order.start_time_id'))->value('time');
        $data['end_time'] = Carbon::parse($data['start_time'])->addMinutes(session('order.addMinutes'))->toTimeString();

        return view('livewire.order-summary', [
            'data' => $data,
            'treatments' => $treatments,
        ]);
    }
}
