<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderSummary extends Component
{
    protected $listeners = ['timeChanged'];

    public function timeChanged()
    {
        $this->render();
    }

    public function render()
    {

        $start_time = \App\Models\Slot::where('id', session('start_time_id'))->value('time');
        $time = Carbon::parse($start_time);

        // dd($time);

        return view('livewire.order-summary', [
            'nama_kecamatan' => DB::table('kecamatans')->where('id', session('kecamatanId'))->value('name'),
            'nama_bidan' => \App\Models\User::where('id', session('midwifeId'))->value('name'),
            // 'start_time' => $start_time->time,
            // 'end_time' => \Carbon\Carbon::createFromFormat('H:i:s',$start_time->time)->addMinutes(45),
        ]);
    }
}
