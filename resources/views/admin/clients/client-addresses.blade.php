<x-action-section>
    <x-slot name="title">Alamat</x-slot>

    <x-slot name="content">
        <div class="space-y-1">
            <div class="max-w-lg">
                <div class="relative z-0 space-y-2">
                    @forelse ($addresses as $index => $address)
                        <div class="relative px-4 py-3 inline-flex w-full border border-gray-200  cursor-pointer rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 {{ $index > 0 ? 'border-t border-gray-200 rounded-t-none' : '' }} {{ ! $loop->last ? 'rounded-b-none' : '' }}">
                            <div class="w-full">
                                <div class="flex items-center justify-between ">
                                    <div class="flex items-center">
                                        <div class="text-sm font-semibold capitalize text-gray-600 {{ $address->is_main ? 'font-semibold' : '' }}"
                                            wire:click="setAddressAsMain('{{ $address->id }}')"
                                        >
                                            {{ $address->label }}
                                        </div>

                                        @if ($address->is_main)
                                            <div class="flex items-center ml-2 text-green-400">
                                                <svg class="w-5 h-5 mr-1" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <div class="text-sm">Alamat Utama</div>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="py-3 text-sm font-semibold text-brand-200" wire:click="showEditAddressDialog({{ $address->id }})">
                                        Edit Alamat
                                    </div>
                                </div>

                                <div class="text-sm text-left text-gray-600">
                                    <div wire:click="setAddressAsMain('{{ $address->id }}')">
                                        {{ $address->full_address }}
                                        <div class="py-2">{{ $address->note ?? '' }}</div>
                                    </div>
                                    @if (isset($address->share_location))
                                        <a href="{{ $address->share_location }}" class="flex items-center text-brand-200" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M18 6l0 .01"></path>
                                                <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5"></path>
                                                <path d="M10.5 4.75l-1.5 -.75l-6 3l0 13l6 -3l6 3l6 -3l0 -2"></path>
                                                <path d="M9 4l0 13"></path>
                                                <path d="M15 15l0 5"></path>
                                            </svg>
                                            <span class="ml-2">Lihat Share location</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-red-600">Belum ada alamat</div>
                    @endforelse
                </div>
            </div>
        </div>
        <x-secondary-button
            wire:click="showAddNewAddressDialog"
            class="mt-2 mr-2"
            type="button"
        >
            {{ __('Tambah Alamat Baru') }}
        </x-secondary-button>

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
                        <x-input wire:model.defer="state.address" class="w-full" type="text" id="state.address" placeholder="Nama jalan, Nomor Rumah, RT/RW"/>
                        <x-input-error for="state.address" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="state.desa">Desa/Kelurahan</x-label>
                        <x-input wire:model.defer="state.desa" class="w-full" type="text" id="state.desa" />
                        <x-input-error for="state.desa" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="state.kecamatan_id">Kecamatan</x-label>
                        <select wire:model.defer="state.kecamatan_id" class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.kecamatan_id">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="state.kecamatan_id" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="state.note">Catatan Petunjuk Tempat</x-label>
                        <x-textarea wire:model.defer="state.note" class="w-full" type="text" id="state.note" />
                        <x-input-error for="state.note" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="state.share_location">Share Location</x-label>
                        <x-textarea wire:model.defer="state.share_location" class="w-full" type="text" id="state.share_location" />
                        <x-input-error for="state.share_location" class="mt-2" />
                    </div>
                </div>
                <div class="py-4">
                    <x-button-on-modal/>
                </div>
            </form>
        </x-dialog>
    </x-slot>
</x-action-section>
