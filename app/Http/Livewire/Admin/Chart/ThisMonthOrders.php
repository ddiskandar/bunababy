<?php

namespace App\Http\Livewire\Admin\Chart;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class ThisMonthOrders extends Component
{
    public $readyToLoad = false;
    public $selectedMonth;
    public $labels;
    public $datasets;
    public $filterStatus;
    public $midwives;

    public function mount()
    {
        $this->midwives = User::midwives()->pluck('name', 'id');
        $this->selectedMonth = today()->isoFormat('YYYY-MM');
        $this->updateData();
    }

    public function updateData()
    {
        $period = Carbon::parse($this->selectedMonth)->startOfMonth()
            ->DaysUntil(Carbon::parse($this->selectedMonth)->endOfMonth());
        foreach ($period as $date) {
            $this->labels[] = $date->isoFormat('D');
        }

        $thisMonthOrders = Order::whereMonth('start_datetime', Carbon::parse($this->selectedMonth))->get();


        $this->datasets = [];

        foreach ($this->midwives as $id => $midwife) {
            $data = [];
            foreach ($period as $date) {
                $data[] = $thisMonthOrders->where('midwife_user_id', $id)
                    ->filter(fn ($item) => $date->isSameDay($item->start_datetime))
                    ->count();
            }
            $this->datasets[] = [
                'label' => $midwife,
                'data' => $data,
            ];
        }

        $this->emit('this-month-orders-updated');
    }

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function updatedSelectedMonth()
    {
        $this->updateData();
    }

    public function prevMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)->subMonth()->isoFormat('YYYY-MM');
        $this->updateData();
    }

    public function nextMonth()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)->addMonth()->isoFormat('YYYY-MM');
        $this->updateData();
    }

    public function render()
    {
        if ($this->readyToLoad) {
            //
        }

        return view('admin.chart.this-month-orders');
    }
}
