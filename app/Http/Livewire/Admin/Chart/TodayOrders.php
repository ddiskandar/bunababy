<?php

namespace App\Http\Livewire\Admin\Chart;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class TodayOrders extends Component
{
    public $readyToLoad = false;
    public $selectedDay;
    public $labels;
    public $midwives;

    public $ordersFinished;
    public $ordersActive;
    public $ordersPending;

    public function mount()
    {
        $this->midwives = User::midwives()->pluck('name', 'id');
        $this->labels = User::midwives()->pluck('name');
        $this->selectedDay = today()->toDateString();
        $this->updateData();
    }

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function updateData()
    {
        $ordersOnSelectedDay = Order::whereDate('date', $this->selectedDay)->get();
        $this->ordersFinished = [];
        $this->ordersActive = [];
        $this->ordersPending = [];

        foreach ($this->midwives as $id => $midwife) {
            $this->ordersFinished[] = $ordersOnSelectedDay->where('midwife_user_id', $id)->where('status', Order::STATUS_FINISHED)->count();
            $this->ordersActive[] = $ordersOnSelectedDay->where('midwife_user_id', $id)->where('status', Order::STATUS_LOCKED)->count();
            $this->ordersPending[] = $ordersOnSelectedDay->where('midwife_user_id', $id)->where('status', Order::STATUS_UNPAID)->count();
        }
        $this->emit('today-orders-updated');
    }

    public function updatedSelectedDay()
    {
        $this->updateData();
    }

    public function prevDay()
    {
        $this->selectedDay = Carbon::parse($this->selectedDay)->subDay()->toDateString();
        $this->updateData();
    }

    public function nextDay()
    {
        $this->selectedDay = Carbon::parse($this->selectedDay)->addDay()->toDateString();
        $this->updateData();
    }

    public function render()
    {
        if ($this->readyToLoad) {
            //
        }

        return view('admin.chart.today-orders');
    }
}
