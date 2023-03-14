<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 md:w-1/3">
                <h3 class="mb-2 font-semibold">
                    <span>Pasien dan Bidan</span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Pilih pasien dan jadwal bidan tersedia
                </p>
            </div>
            <div class="md:w-2/3 md:pl-2">
                <div class="max-w-lg space-y-6 ">
                    <div class="space-y-1">
                        <x-label for="state.placeId">Tempat</x-label>
                        <select wire:model="state.placeId" wire:change="setSelectedPlace" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.placeId">
                            <option value="">--Pilih salah satu</option>
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

                    @if ($selectedPlace)
                    @livewire('admin.orders.select-client')
                    @endif

                    @if ($selectedClient)
                    <div class="space-y-1">
                        <x-label for="state.kecamatanId">Kecamatan</x-label>
                        <select wire:model="state.kecamatanId" wire:change="setSelectedKecamatan" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.kecamatanId">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="state.kecamatanId" class="mt-2" />
                    </div>
                    @endif

                    @if ($selectedKecamatan)
                    <div class="space-y-1">
                        <x-label for="state.date">Tanggal Treatment</x-label>
                        <x-input wire:model="state.date" class="w-full" type="date" id="state.date" />
                        <x-input-error for="state.date" class="mt-2" />
                    </div>
                    @endif

                    @if (isset($state['date']))
                    <div class="inline-flex items-center">
                        <div class="flex items-center h-5 ">
                            <input type="checkbox" wire:model.lazy="showAllMidwives" name="showAllMidwives" class="w-12 transition-all duration-150 ease-out rounded-full cursor-pointer form-switch h-7 text-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50">
                        </div>
                        <div class="ml-4">
                            <x-label for="showAllMidwives">
                                @if ($showAllMidwives)
                                    Semua bidan
                                @elseif (! $showAllMidwives && $selectedPlace->type === \App\Models\Place::TYPE_CLINIC)
                                    Hanya Bidan dengan jadwal di {{ $selectedPlace->name }}
                                @else
                                    Hanya Bidan dengan jangkauan di {{ $selectedKecamatan->name }}
                                @endif
                            </x-label>
                        </div>
                    </div>
                    @endif

                    @if (isset($state['date']))
                        <div class="space-y-1">
                            <x-label for="state.midwifeId">Bidan</x-label>
                            <select wire:model="state.midwifeId" wire:change="setSelectedMidwife" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.midwifeId">
                                <option value="" selected>-- Pilih salah satu</option>
                                @if ($showAllMidwives)
                                    @foreach ($midwives as $midwife)
                                        <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                                    @endforeach
                                @elseif ($selectedPlace->type === \App\Models\Place::TYPE_CLINIC && !$showAllMidwives)
                                    @foreach ($midwives as $midwife)
                                        <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($kecamatan->midwives as $midwife)
                                        <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error for="state.midwifeId" class="mt-2" />
                        </div>

                    @endif

                    @if ($selectedMidwife)
                    <div class="space-y-1">
                        <x-label for="time">Waktu Treatment</x-label>
                        <div class="-mt-4 divide-y divide-bunababy-50">
                            @foreach ($data as $key => $value)
                                <div class="py-4">
                                    <h3 class="mb-2 text-sm font-semibold">{{ $key }}</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($value as $slot)
                                            @if( \Carbon\Carbon::parse($state['date'].$slot['time'])->gt(now()))

                                                @php
                                                    $isSelected = $slot['id'] === $state['startTimeId'] ?? '';
                                                    $isAvailable = '';
                                                    $inRange = \Carbon\Carbon::parse($slot['time'])->isBetween(\Carbon\Carbon::parse($state['startTime']), \Carbon\Carbon::parse($state['startTime'])->addMinutes($state['addMinutes'])); // TODO : add minutes
                                                @endphp

                                                @if ($slot['status'] === 'empty')
                                                <button
                                                    wire:click="selectTime({{ $slot['id'] }})"
                                                    @class([
                                                        'inline-flex items-center justify-center w-14 md:w-20  text-xs font-semibold leading-5 border rounded-full ',
                                                        'border-slate-200 ' => ! $isSelected,
                                                        'border-transparent bg-bunababy-50 text-bunababy-200' => $isSelected,
                                                        'ring-2 ring-offset-1 ring-bunababy-100/50' => $inRange,
                                                    ])
                                                    >
                                                    <span
                                                        @class([
                                                            'w-2 h-2 mr-1 rounded-full ',
                                                            'bg-green-600' => ! $isSelected,
                                                            'bg-bunababy-200' => $isSelected,
                                                        ])
                                                    ></span>
                                                    <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
                                                </button>

                                                @else

                                                <button class="inline-flex items-center justify-center text-xs font-semibold leading-5 text-red-200 border border-red-200 rounded-full cursor-not-allowed w-14 md:w-20 bg-red-50" >
                                                    <span class="w-2 h-2 mr-1 bg-red-300 rounded-full" ></span>
                                                    <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
                                                </button>

                                                @endif

                                            @else

                                            {{-- Slot tidak aktif --}}
                                            <button class="inline-flex items-center justify-center text-xs font-semibold leading-5 border rounded-full cursor-not-allowed w-14 md:w-20 text-slate-200 border-slate-200 bg-slate-50" >
                                                <span class="w-2 h-2 mr-1 rounded-full bg-slate-300" ></span>
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

                    @if (isset($state['startTimeId']))
                    <div class="flex items-center">
                        <div>
                            <x-button wire:click="save" wire:loading.attr="disabled">
                                Tambah
                            </x-button>
                        </div>
                        <x-action-message class="ml-3" on="saved">
                            {{ __('Berhasil ditambahkan') }}
                        </x-action-message>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
