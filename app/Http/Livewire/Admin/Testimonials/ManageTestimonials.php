<?php

namespace App\Http\Livewire\Admin\Testimonials;

use App\Models\Testimonial;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ManageTestimonials extends Component
{
    use WithPagination;

    public $perPage = 3;

    public $showDialog = false;
    public $successMessage = false;

    public $filterSearch;
    public $filterRate;
    public $filterMidwife;

    public $state = [];

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'filterMidwife' => ['except' => ''],
        'filterRate' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 3],
    ];

    protected $rules = [
        'state.name' => 'required',
        'state.desc' => 'required',
        'state.price' => 'required',
        'state.duration' => 'required',
        'state.order' => 'required',
        'state.category_id' => 'required',
        'state.active' => 'required',
    ];

    protected $validationAttributes = [
        'state.name' => 'nama',
        'state.desc' => 'deskripsi',
        'state.price' => 'harga',
        'state.duration' => 'durasi',
        'state.order' => 'urutan',
        'state.category_id' => 'kategori',
        'state.active' => 'status aktif',
    ];

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingFilterSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterRate()
    {
        $this->resetPage();
    }

    public function updatingFilterMidwife()
    {
        $this->resetPage();
    }

    public function save()
    {
        $this->validate();

        $this->showDialog = false;
        $this->successMessage = true;
    }

    public function delete(Testimonial $testimonial)
    {
        $testimonial->delete();
    }

    public function render()
    {
        $testimonials = Testimonial::query()
            ->where(function ($query) {
                $query->whereHas('order', function ($query) {
                    $query->whereHas('client', function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->filterSearch . '%');
                    })->orWhere('id', 'LIKE', '%' . $this->filterSearch . '%');
                })
                    ->orWhere('description', 'LIKE', '%' . $this->filterSearch . '%');
            })
            ->whereHas('order', function ($query) {
                $query->where('midwife_user_id', 'LIKE', '%' . $this->filterMidwife . '%');
            })
            ->where('rate', 'LIKE', '%' . $this->filterRate . '%')
            ->with(
                'order:id,client_user_id,midwife_user_id,start_datetime',
                'order.midwife',
                'order.client',
                'order.client.profile:user_id,photo'
            )
            ->latest()
            ->paginate($this->perPage);

        $midwives = DB::table('users')->where('type', User::MIDWIFE)->get();

        return view('admin.testimonials.manage-testimonials', [
            'testimonials' => $testimonials,
            'midwives' => $midwives,
        ]);
    }
}
