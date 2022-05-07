<?php

namespace App\Http\Livewire\Midwives;

use App\Models\User;
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
            ->where(function($query){
                $query->where('name', 'LIKE', '%' . $this->filterSearch . '%')
                ->orWhereHas('kecamatans', function ($query) {
                    $query->where('name', 'like', '%' . $this->filterSearch . '%');
                });
            })
            ->where('active', 'LIKE', '%' . $this->filterStatus . '%')
            ->with('kecamatans', 'reviews', 'profile:id,user_id,photo')
            ->paginate($this->perPage);

        return view('midwives.manage-midwives', [
            'midwives' => $midwives,
        ]);
    }
}
