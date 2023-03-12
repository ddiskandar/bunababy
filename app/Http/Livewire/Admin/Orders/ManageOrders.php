<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Exports\OrdersExport;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ManageOrders extends Component
{
    use WithPagination;

    public $perPage = 3;

    public $filterFromDate;
    public $filterToDate;

    public $filterSearch;
    public $filterStatus;
    public $filterMidwife;
    public $filterPlace;

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 3],
        'filterStatus' => ['except' => ''],
        'filterPlace' => ['except' => ''],
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

    public function updatingFilterPlace()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->filterFromDate = today()->startOfMonth()->toDateString();
        $this->filterToDate = today()->endOfMonth()->toDateString();
    }

    public function export()
    {
        $name = 'Semua ';

        if ($this->filterMidwife) {
            $name = User::where('id', $this->filterMidwife)->value('name') ?? 'Belum Dipilih Bidan';
        }

        return (new OrdersExport)
            ->filter(
                $this->filterFromDate,
                $this->filterToDate,
                $this->filterSearch,
                $this->filterStatus,
                $this->filterMidwife,
                $this->filterPlace,
            )
            ->download($name . ' - ' . $this->filterFromDate . ' - ' . $this->filterToDate . '.xlsx');
    }

    public function render()
    {
        $query = Order::query()
            ->when(auth()->user()->isMidwife(), function ($query) {
                $query->where('midwife_user_id', auth()->id());
            })
            ->where(function ($query) {
                $query->where('no_reg', 'LIKE', '%' . $this->filterSearch . '%')
                    ->orWhereHas('client', function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->filterSearch . '%')
                            ->orWhereHas('addresses.kecamatan', function ($query) {
                                $query->where('name', 'like', '%' . $this->filterSearch . '%');
                            });
                    });
            })
            ->whereBetween('start_datetime', [$this->filterFromDate, Carbon::parse($this->filterToDate)->addDay()->toDateString()])
            ->where('place_id', 'LIKE', '%' . $this->filterPlace . '%')
            ->where('status', 'LIKE', '%' . $this->filterStatus . '%')
            ->when($this->filterMidwife === "belumDipilih",
                fn ($query) => $query->where('midwife_user_id', null),
                fn ($query) => $query->where('midwife_user_id', 'LIKE', '%' . $this->filterMidwife . '%')
            )->with('client', 'treatments');

        $summary = $query->get();

        $data['total_orders'] = $summary->count();
        $data['total_price'] = $summary->sum('total_price');
        $data['total_transport'] = $summary->sum('total_transport');
        $data['grand_total'] = $data['total_price'] + $data['total_transport'];

        $orders = $query->latest('start_datetime')
            ->simplePaginate($this->perPage);

        $midwives = DB::table('users')->where('type', User::MIDWIFE)->get();

        return view('admin.orders.manage-orders', [
            'orders' => $orders,
            'midwives' => $midwives,
            'data' => $data,
        ]);
    }
}
