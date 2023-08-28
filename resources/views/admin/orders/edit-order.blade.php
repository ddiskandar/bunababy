<x-action-section>
    <x-slot name="title">Pilihan Tempat dan Bidan</x-slot>

    <x-slot name="content">
        <div class="max-w-lg space-y-4">
            <div class="space-y-1">
                <x-label for="state.placeId">Tempat</x-label>
                <select wire:model="state.placeId" wire:change="setSelectedPlace"
                    class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75"
                    type="text" id="state.placeId">
                    @foreach ($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.placeId" class="mt-2" />
            </div>

            @if ($selectedPlace && $selectedPlace->type === \App\Models\Place::TYPE_CLINIC)
                <div class="space-y-1">
                    <x-label for="state.roomId">Ruangan</x-label>
                    <select wire:model="state.roomId"
                        class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75"
                        type="text" id="state.roomId">
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
                        @if (!isset($order->address_id))
                            <div class="py-3 text-sm text-red-600">Belum ada yang dipilih</div>
                        @endif
                        <x-input-error for="role" class="mt-2" />

                        <div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                            @foreach ($addresses as $index => $address)
                                <button wire:key="{{ $address->id }}" type="button"
                                    class="relative px-4 py-3 inline-flex w-full rounded-lg {{ $index > 0 ? 'border-t border-gray-200 rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }}"
                                    wire:click="setSelectedAddress('{{ $address->id }}')">
                                    <div @class([
                                        'w-full',
                                        'opacity-50' =>
                                            isset($state['addressId']) && $state['addressId'] !== $address->id,
                                    ])>
                                        <!-- Role Name -->
                                        <div class="flex items-center justify-between w-full">
                                            <div class="flex items-center space-x-2">
                                                <div
                                                    class="text-sm capitalize text-gray-600 {{ isset($state['addressId']) && $state['addressId'] === $address->id ? 'font-semibold' : '' }}">
                                                    {{ $address->label }}
                                                </div>

                                                @if (isset($state['addressId']) && $state['addressId'] === $address->id)
                                                    <svg class="w-5 h-5 ml-2 text-green-400" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="ml-1 text-sm text-green-400">Selected</span>
                                                @endif
                                            </div>

                                            @if (isset($state['addressId']) && $state['addressId'] === $address->id)
                                                <div class="text-sm font-semibold text-brand-200"
                                                    wire:click="showEditDialog({{ $address->id }})">
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
                                                    <a href="{{ $address->share_location }}"
                                                        class="flex items-center text-brand-200" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-map-2" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                            </path>
                                                            <path d="M18 6l0 .01"></path>
                                                            <path d="M18 13l-3.5 -5a4 4 0 1 1 7 0l-3.5 5"></path>
                                                            <path d="M10.5 4.75l-1.5 -.75l-6 3l0 13l6 -3l6 3l6 -3l0 -2">
                                                            </path>
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

                <x-secondary-button wire:click="addNewAddress" class="mt-2 mr-2" type="button">
                    {{ __('Tambah Alamat Baru') }}
                </x-secondary-button>

            @endif

            @if (isset($state['addressId']))
                <div class="space-y-1">
                    <x-label for="state.date">Tanggal Treatment</x-label>
                    <x-input wire:model="state.date" class="w-full" type="date" id="state.date"
                        min="{{ today()->toDateString() }}" max="{{ today()->addMonths(6)->toDateString() }}" />
                    <x-input-error for="state.date" class="mt-2" />
                </div>
            @endif

            @if (isset($state['date']))
                <div class="space-y-1">
                    <x-label for="state.midwifeId">Bidan</x-label>
                    <select wire:model="state.midwifeId" wire:change="setSelectedMidwife"
                        class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75"
                        type="text" id="state.midwifeId">
                        <option value="" selected>-- Belum ada yang dipilih</option>
                        @foreach ($midwives as $midwife)
                            <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="state.midwifeId" class="mt-2" />
                </div>
            @endif

            @if ($selectedMidwife)
                <div class="space-y-1">
                    <x-label for="time">Waktu Treatment</x-label>
                    <div class="-mt-4 divide-y divide-brand-50">
                        @foreach ($data as $key => $value)
                            <div wire:key="{{ $state['date'] . '-' . $key }}" class="py-4">
                                <h3 class="mb-2 text-sm font-semibold">{{ $key }}</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($value as $slot)
                                        @if (\Carbon\Carbon::parse($state['date'] . $slot['time'])->gt(now()))
                                            @php
                                                $isSelected = (int) $slot['id'] === (int) $state['startTimeId'];
                                                $isAvailable = '';
                                                $inRange = '';
                                                if (isset($state['startTime'])) {
                                                    $inRange = \Carbon\Carbon::parse($slot['time'])->isBetween(\Carbon\Carbon::parse($state['startTime']), \Carbon\Carbon::parse($state['startTime'])->addMinutes((int) $state['totalDuration']));
                                                }

                                            @endphp

                                            @if ($slot['status'] === 'empty')
                                                <button wire:key="{{ $state['date'] . '-' . $slot['id'] }}"
                                                    wire:click="selectTime({{ $slot['id'] }})"
                                                    @class([
                                                        'inline-flex items-center justify-center w-14 md:w-20  text-xs font-semibold leading-5 border rounded-full ',
                                                        'border-slate-200 ' => !$isSelected,
                                                        'border-transparent bg-brand-50 text-brand-200' => $isSelected,
                                                        'ring-2 ring-offset-1 ring-brand-100/50' => $inRange,
                                                    ])>
                                                    <span @class([
                                                        'w-2 h-2 mr-1 rounded-full ',
                                                        'bg-green-600' => !$isSelected,
                                                        'bg-brand-200' => $isSelected,
                                                    ])></span>
                                                    <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
                                                </button>
                                            @else
                                                <button wire:key="{{ $state['date'] . '-' . $slot['id'] }}"
                                                    @class([
                                                        'inline-flex items-center justify-center text-xs font-semibold leading-5 text-red-200 border border-red-200 rounded-full cursor-not-allowed w-14 md:w-20 bg-red-50',
                                                        'ring-2 ring-offset-1 ring-brand-100/50' => $inRange,
                                                    ])>
                                                    <span class="w-2 h-2 mr-1 bg-red-300 rounded-full"></span>
                                                    <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
                                                </button>
                                            @endif
                                        @else
                                            {{-- Slot tidak aktif --}}
                                            <button wire:key="{{ $state['date'] . '-' . $slot['id'] }}"
                                                class="inline-flex items-center justify-center text-xs font-semibold leading-5 border rounded-full cursor-not-allowed w-14 md:w-20 text-slate-200 border-slate-200 bg-slate-50">
                                                <span class="w-2 h-2 mr-1 rounded-full bg-slate-300"></span>
                                                <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endif

            <div class="flex items-center py-4">
                <x-button wire:click="update" wire:loading.attr="disabled"
                    wire:target="update">{{ __('Simpan') }}</x-button>
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
                        <x-label for="state.address.label">Label</x-label>
                        <x-input wire:model.defer="state.address.label" class="w-full" type="text"
                            id="state.address.label" placeholder="Contoh: Rumah, Kantor" />
                        <x-input-error for="state.address.label" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="state.address.address">Alamat Lengkap</x-label>
                        <x-input wire:model.defer="state.address.address" class="w-full" type="text"
                            id="state.address.address" placeholder="Nama jalan, Nomor Rumah, RT/RW" />
                        <x-input-error for="state.address.address" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label for="state.address.desa">Desa/Kelurahan</x-label>
                        <x-input wire:model.defer="state.address.desa" class="w-full" type="text"
                            id="state.address.desa" />
                        <x-input-error for="state.address.desa" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <x-label for="state.address.kecamatan_id">Kecamatan</x-label>
                        <select @if ($dialogEditMode) disabled @endif
                            wire:model.defer="state.address.kecamatan_id"
                            class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75"
                            type="text" id="state.address.kecamatan_id">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="state.address.kecamatan_id" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <x-label for="state.address.note">Catatan Petunjuk</x-label>
                        <x-textarea wire:model.defer="state.address.note" class="w-full" type="text"
                            id="state.address.note" placeholder="Patokan alamat atau petunjuk menuju lokasi" />
                        <x-input-error for="state.address.note" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <x-label for="state.address.share_location">Lokasi di Google Map</x-label>
                        <x-textarea wire:model.defer="state.address.share_location" class="w-full" type="text"
                            id="state.address.share_location" placeholder="" />
                        <x-input-error for="state.address.share_location" class="mt-2" />
                    </div>

                </div>

                <div class="py-4">
                    <x-button-on-modal />
                </div>
            </form>
        </x-dialog>
    </x-slot>
</x-action-section>
