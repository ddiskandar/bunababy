<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageOrders extends Component
{
    use WithPagination;

    public $perPage = 3;


    public $filterFromDate;
    public $filterToDate;

    public $filterSearch;
    public $filterStatus;
    public $filterMidwife;

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 3],
        'filterStatus' => ['except' => ''],
        'filterMidwife' => ['except' => ''],
        'filterFromDate',
        'filterToDate',
    ];

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFilterFromDate()
    {
        $this->resetPage();
    }

    public function updatingFilterToDate()
    {
        $this->resetPage();
    }

    public function updatingFilterSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingFilterMidwife()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->filterFromDate = today()->subDay(7)->toDateString();
        $this->filterToDate = today()->addDay(7)->toDateString();

    }

    public function render()
    {
        $query = Order::query()
            ->when(auth()->user()->isMidwife(), function ($query) {
                $query->where('midwife_user_id', auth()->id());
            })
            ->where(function($query){
                $query->whereHas('client', function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->filterSearch . '%');
                });
            })->whereBetween('date', [$this->filterFromDate, $this->filterToDate])
            ->where('status', 'LIKE', '%' . $this->filterStatus . '%')
            ->where('midwife_user_id', 'LIKE', '%' . $this->filterMidwife . '%')
            ->with('client', 'treatments');

        $summary = $query->get();

        $data['total_orders'] = $summary->count();
        $data['total_price'] = $summary->sum('total_price');
        $data['total_transport'] = $summary->sum('total_transport');
        $data['grand_total'] = $data['total_price'] + $data['total_transport'];

        $orders = $query->latest('date')
            ->simplePaginate($this->perPage);

        $midwives = \DB::table('users')->where('type', User::MIDWIFE)->get();

        return view('orders.manage-orders', [
            'orders' => $orders,
            'midwives' => $midwives,
            'data' => $data,
        ]);
    }
}
