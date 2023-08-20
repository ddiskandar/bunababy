<?php

namespace App\Http\Livewire\Admin\Notifications;

use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Notifications\DatabaseNotification;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;

class ManageNotifications extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $perPage = 8;

    public $filterStatus;
    public $filterSearch;
    public $filterType;

    public $selectedNotifications = [];

    public $state = [];

    protected $queryString = [
        'page' => ['except' => 1],
        'perPage' => ['except' => 8],
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

    public function markAsRead($notificationId)
    {
        try {
            $this->authorize('manage-notifications');

            $notification = DatabaseNotification::findOrFail($notificationId);
            $notification->markAsRead();

            $this->emit('refreshSidebar');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function markAsUnRead($notificationId)
    {
        try {
            $this->authorize('manage-notifications');

            $notification = DatabaseNotification::findOrFail($notificationId);
            $notification->update(['read_at' => null]);

            $this->emit('refreshSidebar');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function delete($notificationId)
    {
        try {
            $this->authorize('manage-notifications');

            $notification = DatabaseNotification::findOrFail($notificationId);
            $notification->delete();

            $this->emit('refreshSidebar');

            Notification::make()->title(Setting::DELETED_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function deleteSelectedNotificatons()
    {
        try {
            $this->authorize('manage-notifications');

            foreach ($this->selectedNotifications as $notification => $boolean) {
                if ($boolean) {
                    $notification = DatabaseNotification::find($notification);
                    $notification->delete();
                }
            }

            $this->selectedNotifications = '';

            $this->emit('refreshSidebar');

            Notification::make()->title(Setting::DELETED_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function deleteAllNotifications()
    {
        try {
            $this->authorize('manage-notifications');

            auth()->user()->notifications()->delete();

            $this->emit('refreshSidebar');

            Notification::make()->title(Setting::DELETED_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        if ($this->filterStatus === 'unread') {
            $query = auth()->user()->unreadNotifications();
        } elseif ($this->filterStatus === 'read') {
            $query = auth()->user()->readNotifications();
        } else {
            $query = auth()->user()->notifications();
        }

        $notifications = $query
            ->where('data', 'LIKE', '%' . $this->filterSearch . '%')
            ->where('data->type', 'LIKE', '%' . $this->filterType . '%')
            ->latest()
            ->paginate($this->perPage);

        return view('admin.notifications.manage-notifications', [
            'notifications' => $notifications,
            'categories' => DB::table('categories')->get()
        ]);
    }
}
