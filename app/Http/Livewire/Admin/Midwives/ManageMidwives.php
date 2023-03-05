<?php

namespace App\Http\Livewire\Admin\Midwives;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMidwives extends Component
{
    use WithPagination;

    public $perPage = 3;

    public $filterSearch;
    public $filterStatus;

    protected $queryString = [
        'filterSearch' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 3],
        'filterStatus' => ['except' => ''],
    ];

    public function render()
    {
        $midwives = User::query()
            ->where('type', User::MIDWIFE)
            ->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->filterSearch . '%')
                    ->orWhereHas('kecamatans', function ($query) {
                        $query->where('name', 'like', '%' . $this->filterSearch . '%');
                    });
            })
            ->where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->with('kecamatans', 'reviews', 'profile:id,user_id,photo', 'treatments:id,name', 'treatments.category:id,name')
            ->withCount('kecamatans', 'treatments')
            ->paginate($this->perPage);

        return view('admin.midwives.manage-midwives', [
            'midwives' => $midwives,
            'categories' => DB::table('categories')->get()
        ]);
    }
}
