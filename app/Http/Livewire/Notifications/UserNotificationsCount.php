<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;

class UserNotificationsCount extends Component
{
    protected $listeners = ['refreshSidebar' => '$refresh'];

    public function render()
    {
        return view('notifications.user-notifications-count');
    }
}
