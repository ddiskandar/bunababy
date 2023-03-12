<x-action-section>
    <x-slot name="title">Pilihan Tempat dan Bidan</x-slot>

    <x-slot name="content">
        <div class="max-w-lg space-y-4">
            <div class="space-y-1">
                <x-label for="state.placeId">Tempat</x-label>
                <select wire:model="state.placeId" wire:change="setSelectedPlace" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.placeId">
                    @foreach ($places as $place)
                    <option value="{{ $place->id }}">{{ $place->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.placeId" class="mt-2" />
            </div>

            @if ($selectedPlace && $selectedPlace->type === \App\Models\Place::TYPE_CLINIC)
            <div class="space-y-1">
                <x-label for="state.roomId">Ruangan</x-label>
                <select wire:model="state.roomId" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.roomId">
                    <option value="">--Pilih salah satu</option>
                    @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.roomId" class="mt-2" />
            </div>
            @endif

            @if ($selectedPlace->type === \App\Models\Place::TYPE_HOMECARE)
            <div class="space-y-1">
                <div>
                    <x-label for="role" value="{{ __('Alamat') }}" />
                    <x-input-error for="role" class="mt-2" />

                    <div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                        @foreach ($addresses as $index => $address)
                            <button type="button" class="relative px-4 py-3 inline-flex w-full rounded-lg {{ $index > 0 ? 'border-t border-gray-200 rounded-t-none' : '' }} {{ ! $loop->last ? 'rounded-b-none' : '' }}"
                                wire:click="setSelectedAddress('{{ $address->id }}')"
                            >
                                <div class="{{ isset($state['addressId']) && $state['addressId'] !== $address->id ? 'opacity-50' : '' }}">
                                    <!-- Role Name -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <div class="text-sm capitalize text-gray-600 {{isset($state['addressId']) && $state['addressId'] === $address->id ? 'font-semibold' : '' }}">
                                                {{ $address->label }}
                                            </div>

                                            @if (isset($state['addressId']) && $state['addressId'] === $address->id)
                                                <svg class="w-5 h-5 ml-2 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <span class="ml-1 text-sm text-green-400">Selected</span>
                                            @endif
                                        </div>

                                        @if (isset($state['addressId']) && $state['addressId'] === $address->id)
                                        <div class="text-sm font-semibold text-bunababy-200"
                                            wire:click="showEditDialog({{ $address->id }})"
                                        >
                                            Edit Alamat
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Role Description -->
                                    <div class="mt-2 text-sm text-left text-gray-600">
                                        {{ $address->full_address }}
                                        @if (isset($state['addressId']) && $state['addressId'] === $address->id)
                                            <div class="py-2">{{ $address->note ?? '' }}</div>
                                            @if (isset($address->share_location))
                                                <a href="{{ $address->share_location }}" class="flex items-center text-bunababy-200" target="_blank">
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
                                        @endif
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <x-secondary-button
                wire:click="addNewAddress"
                class="mt-2 mr-2"
                type="button"
            >
                {{ __('Tambah Alamat Baru') }}
            </x-secondary-button>

            @endif

            <div class="space-y-1">
                <x-label for="state.midwifeId">Bidan</x-label>
                <select wire:model="state.midwifeId" wire:change="setSelectedMidwife" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.midwifeId">
                    <option value="" selected>-- Belum ada yang dipilih</option>
                    @foreach ($midwives as $midwife)
                        <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.midwifeId" class="mt-2" />
            </div>

            <div class="flex items-center py-4">
                <x-button wire:click="update" wire:loading.attr="disabled" wire:target="update">{{ __('Simpan') }}</x-button>
                <x-action-message class="ml-3" on="saved">
                    {{ __('Berhasil disimpan') }}
                </x-action-message>
            </div>
        </div>

        <x-dialog wire:model="showDialog">
            <form wire:submit.prevent="save">
                <x-title>Alamat</x-title>
                <div class="h-64 mt-2 space-y-3 overflow-y-auto">
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
                        <select @if ($dialogEditMode) disabled @endif wire:model.defer="state.kecamatan_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.kecamatan_id">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="state.kecamatan_id" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <x-label for="state.note">Catatan Petunjuk</x-label>
                        <x-textarea wire:model.defer="state.note" class="w-full" type="text" id="state.note" placeholder="Patokan alamat atau petunjuk menuju lokasi" />
                        <x-input-error for="state.note" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <x-label for="state.share_location">Lokasi di Google Map</x-label>
                        <x-textarea wire:model.defer="state.share_location" class="w-full" type="text" id="state.share_location" placeholder="" />
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
