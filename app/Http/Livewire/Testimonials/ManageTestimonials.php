<?php

namespace App\Http\Livewire\Testimonials;

use App\Models\Testimonial;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

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

    protected $messages = [
        //
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
            ->where('description', 'LIKE', '%' . $this->filterSearch . '%')
            ->orWhere('rate', 'LIKE', '%' . $this->filterRate . '%')
            ->whereHas('order', function ($query) {
                $query->whereHas('client', function ($query) {
                    $query->where('name', 'LIKE', '%' . $this->filterSearch . '%');
                });
                $query->where('midwife_user_id', 'LIKE', '%' . $this->filterMidwife . '%');
            })
            ->with('order', 'order.client', 'order.client.profile')
            ->paginate($this->perPage);

        $midwives = \DB::table('users')->where('type', User::MIDWIFE)->get();

        return view('testimonials.manage-testimonials', [
            'testimonials' => $testimonials,
            'midwives' => $midwives,
        ]);
    }
}
