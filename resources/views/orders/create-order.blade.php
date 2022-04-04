<div class="space-y-4">
    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="text-center md:flex-none md:w-1/3 md:text-left">
        <h3 class="flex items-center justify-center mb-1 space-x-2 font-semibold md:justify-start">
            <span>Pasien dan Bidan</span>
        </h3>
        <p class="mb-5 text-sm text-gray-500">
            Pilih pasien dan jadwal bidan tersedia
        </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 lg:p-6 grow">
            <form onsubmit="return false;" enctype="multipart/form-data" class="space-y-6">

            <div class="space-y-1">
                <x-label class="" for="place">Tempat</x-label>
                <select wire:model="place" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="place">
                    <option value="">--Pilih salah satu</option>
                    <option value="1">Homecare</option>
                    <option value="2">Klinik</option>
                </select>
                <x-input-error for="place" class="mt-2" />
            </div>

            <div class="space-y-1">
                <x-label class="" for="clientId">Client</x-label>
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
                <x-label class="" for="kecamatanId">Kecamatan</x-label>
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
                <x-label class="" for="midwifeId">Bidan</x-label>
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
                <x-label class="" for="midwifeId">Bidan</x-label>
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
                <x-label class="" for="date">Tanggal Treatment</x-label>
                <x-input wire:model="date" class="w-full" type="date" id="date" />
                <x-input-error for="date" class="mt-2" />
            </div>
            @endif

            @if ($orders)
            <div class="space-y-1">
                <x-label class="" for="date">Jadwal Yang Sudah Dipesan</x-label>
                @foreach ($orders as $order)
                    <div class="inline-flex items-center px-4 py-1 space-x-1 text-xs font-semibold leading-4 border rounded-full text-slate-600 bg-slate-50 border-slate-200">
                        {{\Carbon\Carbon::createFromFormat('H:i:s',$order->start_time)->format('h:i')}} - {{\Carbon\Carbon::createFromFormat('H:i:s',$order->end_time)->format('h:i')}}
                    </div>
                @endforeach
            </div>

                @if ($midwifeId)
                <div class="space-y-1">
                    <x-label class="" for="time">Waktu Treatment</x-label>
                    <x-input wire:model="time" class="w-full" type="time" id="time" />
                    <x-input-error for="time" class="mt-2" />
                </div>

                <div class="flex items-center">
                    <div class="">
                        <x-button wire:click="save">Tambah</x-button>
                    </div>
                    <x-action-message class="ml-3" on="saved">
                        {{ __('Berhasil ditambahkan') }}
                    </x-action-message>
                </div>

                @endif

            @endif

            </form>
        </div>
        <!-- Card Body: User Profile -->
        </div>
        <!-- Card: User Profile -->
    </div>
    <!-- END User Profile -->

</div>
