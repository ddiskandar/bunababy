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
    public $data;
    public $filterStatus = '';
    public $midwives;

    public function mount()
    {
        $this->midwives = User::midwives()->pluck('name', 'id');
        $this->selectedMonth = today()->isoFormat('YYYY-MM');
        $this->updateData();
    }

    public function updateData()
    {
        $this->data = [];

        $period = Carbon::parse($this->selectedMonth)->startOfMonth()
            ->DaysUntil(Carbon::parse($this->selectedMonth)->endOfMonth());

        foreach ($period as $date) {
            $this->data['labels'][] = $date->isoFormat('D');
        }

        $thisMonthOrders = Order::query()
            ->whereMonth('date', Carbon::parse($this->selectedMonth))
            ->where('status', 'LIKE', '%' . $this->filterStatus)
            ->get();

        foreach ($this->midwives as $id => $midwife) {
            $data = [];
            foreach ($period as $date) {
                $data[] = $thisMonthOrders->where('midwife_user_id', $id)
                    ->filter(fn ($item) => $date->isSameDay($item->startDateTime))
                    ->count();
            }
            $this->data['datasets'][] = [
                'label' => $midwife,
                'data' => $data,
                'cubicInterpolationMode' => 'monotone',
                'tension' => 0.2
            ];
        }

        $this->emit('this-month-orders-updated');
    }

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function updatedFilterStatus()
    {
        $this->updateData();
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
