<?php

namespace App\Http\Livewire\Calendar;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class ShowCalendar extends Component
{
    public $date;
    public $midwives;
    public $colStart;
    public $rowStart;
    public $times;
    public $selectedDay;

    public function mount(){

        $this->selectedDay = today()->toDateString();

        $this->times = collect([
            ['time' => '08:00', 'row-start' => '2'],
            ['time' => '', 'row-start' => '3'],
            ['time' => '08:30', 'row-start' => '4'],
            ['time' => '', 'row-start' => '5'],
            ['time' => '09:00', 'row-start' => '6'],
            ['time' => '', 'row-start' => '7'],
            ['time' => '09:30', 'row-start' => '8'],
            ['time' => '', 'row-start' => '9'],
            ['time' => '10:00', 'row-start' => '10'],
            ['time' => '', 'row-start' => '11'],
            ['time' => '10:30', 'row-start' => '12'],
            ['time' => '', 'row-start' => '13'],
            ['time' => '11:00', 'row-start' => '14'],
            ['time' => '', 'row-start' => '15'],
            ['time' => '11:30', 'row-start' => '16'],
            ['time' => '', 'row-start' => '17'],
            ['time' => '12:00', 'row-start' => '18'],
            ['time' => '', 'row-start' => '19'],
            ['time' => '12:30', 'row-start' => '20'],
            ['time' => '', 'row-start' => '21'],
            ['time' => '13:00', 'row-start' => '22'],
            ['time' => '', 'row-start' => '23'],
            ['time' => '13:30', 'row-start' => '24'],
            ['time' => '', 'row-start' => '25'],
            ['time' => '14:00', 'row-start' => '26'],
            ['time' => '', 'row-start' => '27'],
            ['time' => '14:30', 'row-start' => '28'],
            ['time' => '', 'row-start' => '29'],
            ['time' => '15:00', 'row-start' => '30'],
            ['time' => '', 'row-start' => '31'],
            ['time' => '15:30', 'row-start' => '32'],
            ['time' => '', 'row-start' => '33'],
            ['time' => '16:00', 'row-start' => '34'],
            ['time' => '', 'row-start' => '35'],
            ['time' => '16:30', 'row-start' => '36'],
            ['time' => '', 'row-start' => '37'],
            ['time' => '17:00', 'row-start' => '38'],
            ['time' => '', 'row-start' => '39'],
            ['time' => '17:30', 'row-start' => '40'],
            ['time' => '', 'row-start' => '41'],
            ['time' => '18:00', 'row-start' => '42'],
        ])->toArray();

        $users = User::query()
            ->where('type', User::MIDWIFE)
            ->active()
            ->select(['id', 'name'])
            ->orderBy('id', 'ASC')
            ->get();

        $this->midwives = collect();
        $this->colStart = collect();

        $this->colStart->put(1, 2);
        $this->midwives->push(['col-start' => 2, 'name' => 'Belum ada']);

        $i = 3;
        foreach($users as $midwife) {
            $this->colStart->put($midwife->id, $i);
            $this->midwives->push(['col-start' => $i, 'name' => $midwife->name]);
            $i++;
        }

        $this->colStart->toArray();

        $this->rowStart = collect([
            '08:00' => '2',
            '08:15' => '3',
            '08:30' => '4',
            '08:45' => '5',
            '09:00' => '6',
            '09:15' => '7',
            '09:30' => '8',
            '09:45' => '9',
            '10:00' => '10',
            '10:15' => '11',
            '10:30' => '12',
            '10:45' => '13',
            '11:00' => '14',
            '11:15' => '15',
            '11:30' => '16',
            '11:45' => '17',
            '12:00' => '18',
            '12:15' => '19',
            '12:30' => '20',
            '12:45' => '21',
            '13:00' => '22',
            '13:15' => '23',
            '13:30' => '24',
            '13:45' => '25',
            '14:00' => '26',
            '14:15' => '27',
            '14:30' => '28',
            '14:45' => '29',
            '15:00' => '30',
            '15:15' => '31',
            '15:30' => '32',
            '15:45' => '33',
            '16:00' => '34',
            '16:15' => '35',
            '16:30' => '36',
            '16:45' => '37',
            '17:00' => '38',
            '17:15' => '39',
            '17:30' => '40',
            '17:45' => '41',
            '18:00' => '42',
            ])->toArray();
    }

    public function prevDay()
    {
        $this->selectedDay = Carbon::parse($this->selectedDay)->subDay()->toDateString();
    }

    public function nextDay()
    {
        $this->selectedDay = Carbon::parse($this->selectedDay)->addDay()->toDateString();
    }

    public function render()
    {
        $schedules = collect();

        $orders = Order::query()
            ->whereDate('start_datetime', $this->selectedDay)
            ->with(
                'client:id,name',
                'treatments:id,name',
                'address.kecamatan:id,name'
            )
            ->select([
                'id',
                'no_reg',
                'client_user_id',
                'midwife_user_id',
                'start_datetime',
                'end_datetime',
                'status',
                'finished_at',
                'address_id',
                'place'
            ])
            ->get();

        foreach($orders as $order){
            $schedules->push([
                'row-start' => $this->rowStart[$order->start_datetime->isoFormat('HH:mm')],
                'col-start' => $order->midwife_user_id ? $this->colStart[$order->midwife_user_id] : 2,
                'row-span' => (int) round($order->start_datetime->diffInMinutes($order->end_datetime) / 15),
                'id' => $order->id,
                'no_reg' => $order->no_reg,
                'client_name' => $order->client->name,
                'time' => $order->start_datetime->isoFormat('HH:mm') . ' - ' . $order->end_datetime->isoFormat('HH:mm') . ' WIB',
                'treatments' => $order->treatments->implode('name', ', '),
                'status' => $order->status(),
                'finished_at' => $order->finished_at,
                'address' => $order->address->kecamatan->name ?? '-',
                'place' =>$order->place()
            ]);
        }

        return view('calendar.show-calendar', [
            'schedules' => $schedules,
        ]);
    }
}
