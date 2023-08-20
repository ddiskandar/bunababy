<?php

namespace App\Http\Livewire\Admin\Clients;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Livewire\Component;
use App\Models\Setting;
use App\Models\User;

class DeleteClient extends Component
{
    use AuthorizesRequests;

    public $showDialog = false;
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function confirmDelete()
    {
        $this->showDialog = true;
    }

    public function delete()
    {
        try {
            $this->authorize('manage-clients');

            $this->user->delete();

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

            return to_route('clients');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('admin.clients.delete-client');
    }
}
