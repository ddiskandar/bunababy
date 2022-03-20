<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class EditMidwife extends Component
{
    public $midwife;

    public $state = [];

    public function mount($id)
    {
        // $this->midwife = User;
        // $this->state = $user->toArray();
        dd($id);
    }

    public function render()
    {
        return view('livewire.admin.edit-midwife');
    }
}
