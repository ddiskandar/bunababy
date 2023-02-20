<?php

namespace App\Http\Livewire\Admin\Notifications;

use Livewire\Component;

class UserNotificationsCount extends Component
{
    protected $listeners = ['refreshSidebar' => '$refresh'];

    public function render()
    {
        return view('admin.notifications.user-notifications-count');
    }
}
