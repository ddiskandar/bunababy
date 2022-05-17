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
                        <x-label for="place">Tempat</x-label>
                        <select wire:model="place" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="place">
                            <option value="">--Pilih salah satu</option>
                            <option value="1">Homecare</option>
                            <option value="2">Klinik</option>
                        </select>
                        <x-input-error for="place" class="mt-2" />
                    </div>

                    <div class="space-y-1">
                        <x-label for="clientId">Client</x-label>
                        <select wire:model="clientId" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="clientId">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="clientId" class="mt-2" />
                    </div>

                    @if ($clientId)
                    <div class="space-y-1">
                        <x-label for="kecamatanId">Kecamatan</x-label>
                        <select wire:model="kecamatanId" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="kecamatanId">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="kecamatanId" class="mt-2" />
                    </div>
                    @endempty

                    @if ($kecamatanId && ! $showAllMidwives)
                    <div class="space-y-1">
                        <x-label for="midwifeId">Bidan</x-label>
                        <select wire:model="midwifeId" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="midwifeId">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($kecamatan->midwives as $midwife)
                                <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="midwifeId" class="mt-2" />
                    </div>
                    <button class="-mt-2 text-xs font-semibold uppercase text-bunababy-200"
                        wire:click="$set('showAllMidwives', true)"
                    >
                        Atau tampilkan semua bidan
                    </button>
                    @endif

                    @if ($kecamatanId && $showAllMidwives)
                    <div class="space-y-1">
                        <x-label for="midwifeId">Bidan</x-label>
                        <select wire:model="midwifeId" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="midwifeId">
                            <option value="" selected>-- Pilih salah satu</option>
                            @foreach ($midwives as $midwife)
                                <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="midwifeId" class="mt-2" />
                    </div>
                    <button class="text-xs font-semibold uppercase text-bunababy-200"
                        wire:click="$set('showAllMidwives', false)"
                    >
                        tampilkan bidan jangkauan
                    </button>
                    @endif

                    @if ($midwifeId)
                    <div class="space-y-1">
                        <x-label for="date">Tanggal Treatment</x-label>
                        <x-input wire:model="date" class="w-full" type="date" id="date" />
                        <x-input-error for="date" class="mt-2" />
                    </div>
                    @endif

                    @if ($date)
                    <div class="space-y-1">
                        <x-label for="time">Waktu Treatment</x-label>
                        <div class="-mt-4 divide-y divide-bunababy-50">
                            <div class="py-4">
                                <h3 class="mb-2 text-sm font-semibold">Pagi</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($data['pagi'] as $slot)
                                        @if( \Carbon\Carbon::parse(session('order.date')->toDateString().$slot['time'])->gt(now()))

                                            @php
                                                $isSelected = $slot['id'] == session('order.start_time_id');
                                                $isAvailable = '';
                                                $inRange = \Carbon\Carbon::parse($slot['time'])->isBetween(\Carbon\Carbon::parse(session('order.start_time')), \Carbon\Carbon::parse(session('order.start_time'))->addMinutes(session('order.addMinutes')));
                                            @endphp

                                            @if ($slot['status'] == 'empty')
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

                                        <button class="inline-flex items-center justify-center text-xs font-semibold leading-5 border rounded-full cursor-not-allowed w-14 md:w-20 text-slate-200 border-slate-200 bg-slate-50" >
                                            <span class="w-2 h-2 mr-1 rounded-full bg-slate-300" ></span>
                                            <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
                                        </button>

                                        @endif

                                    @endforeach
                                </div>
                            </div>

                            <div class="py-4">
                                <h3 class="mb-2 text-sm font-semibold">Siang</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($data['siang'] as $slot)
                                        @if(\Carbon\Carbon::parse(session('order.date')->toDateString().$slot['time'])->gt(now()))

                                            @php
                                                $isSelected = $slot['id'] == session('order.start_time_id');
                                                $isAvailable = '';
                                                $inRange = \Carbon\Carbon::parse($slot['time'])->isBetween(\Carbon\Carbon::parse(session('order.start_time')), \Carbon\Carbon::parse(session('order.start_time'))->addMinutes(session('order.addMinutes')));
                                            @endphp

                                            @if ($slot['status'] == 'empty')
                                            <button
                                                wire:click="selectTime({{ $slot['id'] }})"
                                                @class([
                                                    'inline-flex items-center justify-center w-14 md:w-20  text-xs font-semibold leading-5 border rounded-full ',
                                                    'border-slate-200' => ! $isSelected,
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

                                        <button class="inline-flex items-center justify-center text-xs font-semibold leading-5 border rounded-full cursor-not-allowed w-14 md:w-20 text-slate-200 border-slate-200 bg-slate-50" >
                                            <span class="w-2 h-2 mr-1 rounded-full bg-slate-300" ></span>
                                            <span>{{ \Carbon\Carbon::parse($slot['time'])->format('H:i') }}</span>
                                        </button>

                                        @endif

                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                    @endif

                    @if (session()->has('treatments'))
                    <div class="mb-4 text-sm text-red-600">{{ session('treatments') }}</div>
                    @endif

                    @if (session()->has('order.start_time'))
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

    <x-dialog wire:model="showDialog">

        <div class="py-4 mt-2 overflow-y-auto">
            <div class="text-center">
                Yakin mau dihapus?
            </div>

        </div>

        <div class="py-4">
            <button
                wire:click="delete"
                type="button"
                class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
            >Ya, Hapus Sekarang</button>
        </div>

    </x-dialog>
</div>
