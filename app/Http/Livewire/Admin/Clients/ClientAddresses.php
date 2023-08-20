<?php

namespace App\Http\Livewire\Admin\Clients;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Address;
use App\Models\Setting;
use App\Models\User;

class ClientAddresses extends Component
{
    use AuthorizesRequests;

    public $state = [];

    public $client;
    public $selectedAddressId;
    public $showAddNewAddressForm = false;

    public $showDialog = false;

    protected $rules = [
        'state.label' => 'required|string|min:3|max:32',
        'state.address' => 'required|string|min:3|max:255',
        'state.desa' => 'required|string|min:2|max:32',
        'state.kecamatan_id' => 'required|exists:kecamatans,id',
        'state.note' => 'nullable|string|min:2|max:255',
        'state.share_location' => 'nullable|string|max:255',
    ];


    protected $validationAttributes = [
        'state.label' => 'Label',
        'state.address' => 'Kampung/Jalan',
        'state.desa' => 'Desa',
        'state.kecamatan_id' => 'Kecamatan',
        'state.note' => 'Catatan',
        'state.share_location' => 'Share Location',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount(User $user)
    {
        $this->client = $user;
    }

    public function showAddNewAddressDialog()
    {
        $this->resetErrorBag();
        $this->showDialog = true;
        $this->state = [];
    }

    public function showEditAddressDialog(Address $address)
    {
        $this->resetErrorBag();
        $this->state = $address->toArray();
        $this->showDialog = true;
    }

    public function setAddressAsMain(Address $address)
    {
        try {
            $this->authorize('manage-clients');

            DB::transaction(function() use ($address) {
                $this->client->addresses()->update([
                    'is_main' => false
                ]);

                $address->update([
                    'is_main' => true
                ]);
            });

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $this->authorize('manage-clients');

            $address = Address::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? Address::max('id') + 1,
                ],
                [
                    'client_user_id' => $this->client->id,
                    'label' => $this->state['label'],
                    'address' => $this->state['address'],
                    'desa' => $this->state['desa'],
                    'kecamatan_id' => $this->state['kecamatan_id'],
                    'note' => $this->state['note'] ?? null,
                    'share_location' => $this->state['share_location'] ?? null,
                ]
            );

            $addresses = Address::where('client_user_id', $this->client->id)->get();

            if (!$addresses->contains('is_main', 1)) {
                $address->update(['is_main' => true]);
            }

            $this->emit('saved');

            $this->showDialog = false;

            $this->showAddNewAddressForm = false;

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        $addresses = Address::query()
            ->where('client_user_id', $this->client->id)
            ->get();

        $kecamatans = DB::table('kecamatans')->orderBy('name')->get(['id', 'name']);

        return view('admin.clients.client-addresses', [
            'addresses' => $addresses,
            'kecamatans' => $kecamatans,
        ]);
    }
}
