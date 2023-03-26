<div class="relative">
    <div class="sticky top-0 z-20 px-4 py-4 text-white shadow bg-brand-200 shadow-brand-50">
        <div class="flex items-center justify-between max-w-screen-sm mx-auto">
            <a href="{{ route('client.profile') }}">
                <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                </svg>
            </a>
            <h1 class="flex-1 font-semibold md:text-center">Daftar Alamat</h1>
            <button
                wire:click="addNewAddress"
                class="text-sm "
                >
                Tambah Alamat
            </button>
        </div>
    </div>

    <div class="max-w-screen-sm min-h-screen mx-auto my-0">
        <ul class="py-4 space-y-4">
            @forelse ( $addresses as $address)
            <li @class([
                    'w-full p-6 bg-white border rounded shadow-lg shadow-brand-50',
                    'border-slate-100' => $address->is_main,
                    'border-brand-100' => $address->is_main == true,
                ])>
                <div class="flex items-center mb-2">
                    <div  >
                        <div class="text-xl font-semibold capitalize">{{ $address->label }}</div>
                    </div>
                    @if ($address->is_main)
                        <div class="inline-flex px-4 py-1 ml-2 text-xs font-semibold leading-4 rounded-full text-brand-200 bg-brand-50 ">Utama</div>
                    @else
                        <button class="ml-2 text-sm font-semibold text-brand-200"
                            wire:click="setAsMainAddress({{ $address->id }})"
                            >
                            Jadikan Alamat utama
                        </button>
                    @endif
                </div>
                <div>
                    {{ $address->full_address }}
                </div>
                <div class="py-2">
                    <button class="text-sm font-semibold text-brand-200"
                        wire:click="showEditDialog({{ $address->id }})"
                    >
                        Ubah Alamat
                    </button>
                </div>

            </li>
            @empty

            @endforelse

        </ul>

    </div>

    <x-dialog wire:model="showDialog">
        <form wire:submit.prevent="save">
            <x-title>Alamat</x-title>
            <div class="h-64 px-1 mt-2 space-y-3 overflow-y-auto">
                <div class="space-y-1">
                    <x-label for="state.label">Label</x-label>
                    <x-input wire:model.defer="state.label" class="w-full" type="text" id="state.label" placeholder="Contoh: Rumah, Kantor" />
                    <x-input-error for="state.label" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label for="state.address">Alamat Lengkap</x-label>
                    <x-input wire:model.defer="state.address" class="w-full" type="text" id="state.address" placeholder="Nama jalan, Nomor Rumah, RT/RW" />
                    <x-input-error for="state.address" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label for="state.desa">Desa/Kelurahan</x-label>
                    <x-input wire:model.defer="state.desa" class="w-full" type="text" id="state.desa" />
                    <x-input-error for="state.desa" class="mt-2" />
                </div>

                <div class="space-y-1">
                    <x-label for="state.kecamatan_id">Kecamatan</x-label>
                    <select @if ($dialogEditMode) disabled @endif wire:model.defer="state.kecamatan_id" class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.kecamatan_id">
                        <option value="" selected>-- Pilih salah satu</option>
                        @foreach ($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="state.kecamatan_id" class="mt-2" />
                </div>

                <div class="space-y-1">
                    <x-label for="state.note">{{ __('Catatan Petunjuk') }}</x-label>
                    <x-textarea wire:model.defer="state.note" class="placeholder:text-xs" rows=3 class="w-full" type="text" id="state.note" placeholder="Patokan alamat atau petunjuk menuju lokasi" />
                    <x-input-error for="state.note" class="mt-2" />
                </div>

            </div>

            <div class="py-4">
                <x-button-on-modal/>
            </div>

        </form>
    </x-dialog>

</div>
