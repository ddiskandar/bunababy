<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderSummary extends Component
{
    protected $listeners = ['timeChanged', 'treatmentAdded'];

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

    public function render()
    {
        $addMinutes = session('order.addMinutes') ?? 40;

        $data['kecamatan'] = DB::table('kecamatans')->where('id', session('order.kecamatan_id'))->value('name');
        $data['bidan'] = \App\Models\User::where('id', session('order.midwife_user_id'))->value('name');
        $data['date'] = session('order.date')->isoFormat('dddd, D MMMM G');
        $data['start_time'] = DB::table('slots')->where('id', session('order.start_time_id'))->value('time');
        $data['end_time'] = Carbon::parse($data['start_time'])->addMinutes($addMinutes)->toTimeString();

        $start_time = \App\Models\Slot::where('id', session('order.start_time_id'))->value('time');
        $time = Carbon::parse($start_time);

        return view('livewire.order-summary', [
            'data' => $data,
        ]);
    }
}
