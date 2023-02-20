<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Tag;
use App\Models\User;
use Livewire\Component;

class ClientTag extends Component
{
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

        $this->client->tags()->attach($this->tagId);
        $this->emit('saved');
    }

    public function deleteTag($id)
    {
        $this->client->tags()->detach($id);
        $this->emit('saved');
    }


    public function render()
    {
        $tags = \DB::table('tags')
            ->whereNotIn('id', $this->client->tags->pluck('id'))
            ->orderBy('name')
            ->get();

        return view('admin.clients.client-tag', [
            'tags' => $tags,
        ]);
    }
}
