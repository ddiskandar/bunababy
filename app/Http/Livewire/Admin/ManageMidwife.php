<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMidwife extends Component
{
    use WithPagination;

    public $perPage = 6;

    public $filterSearch;
    public $filterStatus;

    public $state = [];

    protected $queryString = [];

    protected $rules = [];

    protected $messages = [];

    protected $validationAttributes = [];

    public function save()
    {
        //
    }


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

            ->with('kecamatans')
            ->paginate($this->perPage);

        return view('midwives.manage-midwife', [
            'midwives' => $midwives,
        ]);
    }
}
