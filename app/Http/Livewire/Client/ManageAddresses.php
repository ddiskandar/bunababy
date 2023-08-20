<?php

namespace App\Http\Livewire\Client;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Address;
use App\Models\Setting;

class ManageAddresses extends Component
{
    use AuthorizesRequests;

    public $state = [];

    public $addresses;
    public $showDialog = false;
    public $dialogEditMode = false;

    protected $rules = [
        'state.label' => 'required|string|min:3|max:32',
        'state.address' => 'required|string|min:3|max:255',
        'state.desa' => 'required|string|min:2|max:32',
        'state.kecamatan_id' => 'required|exists:kecamatans,id',
        'state.note' => 'nullable|string|min:2|max:255',
    ];

    protected $validationAttributes = [
        'state.label' => 'Label alamat',
        'state.address' => 'Alamat lengkap',
        'state.desa' => 'Desa/Kelurahan',
        'state.kecamatan_id' => 'Kecamatan',
        'state.note' => 'Catatan',
    ];

    protected $listeners = ['saved' => '$refresh'];

    public function mount()
    {
        $this->addresses = Address::query()
            ->where('client_user_id', auth()->id())
            ->with('kecamatan', 'kecamatan.kabupaten')
            ->get();
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function showEditDialog(Address $address)
    {
        $this->state = $address->toArray();
        $this->showDialog = true;
        $this->dialogEditMode = true;
    }

    public function addNewAddress()
    {
        $this->state = [];
        $this->showDialog = true;
        $this->dialogEditMode = false;
    }

    public function setAsMainAddress($id)
    {
        try {
            foreach ($this->addresses as $address) {

                $this->authorize('update', $address);

                $address->update(['is_main' => false]);

                if ($address->id === $id) {
                    $address->update(['is_main' => true]);
                }
            }

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
            $this->authorize('create', Address::class);

            $address = Address::updateOrCreate(
                [
                    'id' => $this->state['id'] ?? time(),
                    'client_user_id' => auth()->id(),
                    'kecamatan_id' => $this->state['kecamatan_id'],
                ],
                [
                    'label' => $this->state['label'],
                    'address' => $this->state['address'],
                    'desa' => $this->state['desa'],
                    'note' => $this->state['note'] ?? '',
                ]
            );

            $addresses = Address::where('client_user_id', auth()->id())->get();

            if (!$addresses->contains('is_main', Address::MAIN_ADDRESS)) {
                $address->update(['is_main' => true]);
            }

            $this->showDialog = false;

            Notification::make()->title(Setting::SUCCESS_MESSAGE)->success()->send();

            return to_route('client.addresses');

        } catch (\Throwable $th) {
            report($th->getMessage());
            Notification::make()->title(Setting::ERROR_MESSAGE)->danger()->send();
        }
    }

    public function render()
    {
        return view('client.profile.manage-addresses', [
            'kecamatans' => DB::table('kecamatans')->orderBy('name')->select(['id', 'name'])->get(),
        ])->layout('layouts.client');
    }
}
