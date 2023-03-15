<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Option;
use App\Models\Order;
use App\Models\Place;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CartSummary extends Component
{
    public $showDialog = false;

    protected $listeners = [
        'timeChanged' => '$refresh',
        'treatmentAdded' => '$refresh',
        'treatmentDeleted' => '$refresh',
        'newUser'
    ];

    public function deleteTreatments($id)
    {
        $treatments = collect(session('order.treatments'))->where('treatment_id', $id);

        foreach ($treatments as $key => $treatment) {
            session()->forget('order.treatments.' . $key);
            session()->decrement('order.addMinutes', $treatment['treatment_duration']);
        }

        $this->emit('treatmentDeleted');
    }

    public function checkout()
    {
        $startTime = Carbon::parse(Carbon::parse(session('order.date'))->toDateString() . ' ' . session('order.start_time'));

        $orders = Order::query()
            ->when(session('order.place_type') === Place::TYPE_HOMECARE,
                fn ($query) => $query->where('midwife_user_id', session('order.midwife_user_id')))
            ->when(session('order.place_type') === Place::TYPE_CLINIC,
                fn ($query) => $query->where('room_id', session('order.room_id'))
            )
            ->whereDate('start_datetime', session('order.date'))
            ->activeBetween($startTime->toDateTimeString(), $startTime
                ->addMinutes(
                    (int) session('order.addMinutes') + (int) session('order.place_transport_duration')
                )->toDateTimeString()
            );

        if ($orders->exists()) {
        Notification::make()
            ->title('Jadwal Reservasi Bentrok!')
            ->danger()
            ->send();

            return back();
        }

        return to_route('order.checkout');
    }

    public function render()
    {
        $treatments = collect(session('order.treatments')) ?? [];

        $treatments = $treatments->mapToGroups(function ($item, $key) {
            return [$item['treatment_name'] => [
                'family_name' => $item['family_name'],
                'treatment_id' => $item['treatment_id'],
                'treatment_name' => $item['treatment_name'],
                'treatment_desc' => $item['treatment_desc'],
                'treatment_price' => $item['treatment_price'],
                'treatment_duration' => $item['treatment_duration'],
            ]];
        });

        $order = new Order();

        if (session('order.place_type') === Place::TYPE_HOMECARE) {
            $bidan = \App\Models\User::where('id', session('order.midwife_user_id'))->first();
            $data['bidan'] = $bidan->name;
            $data['bidan_photo'] = $bidan->profile_photo_url;
            $data['kecamatan'] = DB::table('kecamatans')->where('id', session('order.kecamatan_id'))->value('name');
        }

        $data['date'] = tanggal(session('order.date'));
        $data['time'] = waktu($order->getStartTime()) . ' - ' . waktu($order->getEndTime()) . ' WIB ';
        $data['total_price'] = rupiah($order->getTotalPrice());
        $data['total_transport'] = rupiah($order->getTotalTransport());
        $data['grand_total'] = session()->has('order.treatments') && session('order.treatments') !== []
            ? rupiah($order->getTotalTransport() + $order->getTotalPrice())
            : rupiah(0);

        return view('client.order.cart-summary', [
            'data' => $data,
            'treatments' => $treatments,
        ]);
    }
}
