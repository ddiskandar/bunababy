<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\User;
use Filament\Notifications\Notification;

class ClientTag extends Component
{
    use AuthorizesRequests;

    public $client;
    public $tagId;

    protected $listeners = ['saved' => '$refresh'];

    protected $rules = [
        'tagId' => 'required'
    ];

    protected $validationAttributes = [
        'tagId' => 'Tag'
    ];

    public function mount(User $user)
    {
        $this->client = $user;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-clients');

            $this->client->tags()->attach($this->tagId);
            $this->tagId = null;
            $this->emit('saved');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function deleteTag($id)
    {
        try {
            $this->authorize('manage-clients');

            $this->client->tags()->detach($id);

            $this->emit('saved');

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }


    public function render()
    {
        $tags = DB::table('tags')
            ->whereNotIn('id', $this->client->tags->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.clients.client-tag', [
            'tags' => $tags,
        ]);
    }
}
