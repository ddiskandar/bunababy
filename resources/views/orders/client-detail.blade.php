<div class="space-y-4">

    <div class="flex flex-col overflow-hidden bg-white shadow-sm ">
        <!-- Card Body: User Profile -->
        <div class="items-center justify-between w-full p-5 lg:p-6 grow md:flex">
            <div class="space-y-2 md:space-y-0 md:space-x-3 md:items-center md:flex">
                <span class="inline-flex items-center px-2 text-xs font-semibold leading-5 text-green-500 uppercase border border-green-300 rounded-full bg-green-50">
                    <span class="w-2 h-2 mr-2 bg-green-600 rounded-full"></span>
                    <span class="">{{ $order->status() }}</span>
                </span>
                <div class="text-2xl font-semibold">{{ $order->client->name }}</div>
                <div class="hidden md:block">/</div>
                <div>{{ $order->client->profile->phone }}</div>
            </div>
            <div class="flex items-center justify-between mt-4 space-x-4 md:mt-0 md:justify-end">

                <a href="{{ url()->previous() }}">
                    <x-secondary-button class="" type="button" >
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                          </svg>

                        {{ __('Kembali') }}
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </div>

    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="mb-4 md:flex-none md:w-1/3">
            <h3 class="font-semibold">
                <span>Bidan </span>
            </h3>
            <p class="mb-5 text-sm text-gray-500">
                Pilihan bidan dengan waktu yang tersedia
            </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 lg:p-6 grow">
            <form onsubmit="return false;" enctype="multipart/form-data" class="space-y-6">

            <div class="space-y-1">
                <x-label class="" for="state.midwife_user_id">Bidan</x-label>
                <select wire:model.defer="state.midwife_user_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.midwife_user_id">
                    <option value="" selected>-- Pilih salah satu</option>
                    @foreach ($midwives as $midwife)
                        <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.midwife_user_id" class="mt-2" />
            </div>

            <div class="space-y-1">
                <x-label class="" for="date">Tanggal Treatment</x-label>
                <x-input wire:model.defer="date" class="w-full" type="date" id="date" />
                <x-input-error for="date" class="mt-2" />
            </div>

            <div class="space-y-1">
                <x-label class="" for="state.start_time">Waktu Mulai Treatment</x-label>
                <x-input wire:model.defer="state.start_time" class="w-full" type="time" id="state.start_time" />
                <x-input-error for="state.start_time" class="mt-2" />
            </div>

            <div class="flex items-center">
                <div class="">
                    <x-button wire:click="save">Simpan</x-button>
                </div>
                <x-dirty-message class="ml-3" target="state.midwife_user_id, date, state.start_time">
                    {{ __('Belum disimpan!') }}
                </x-dirty-message>

                <x-action-message class="ml-3" on="saved">
                    {{ __('Berhasil disimpan') }}
                </x-action-message>
            </div>

            </form>
        </div>
        <!-- Card Body: User Profile -->
        </div>
        <!-- Card: User Profile -->
    </div>
    <!-- END User Profile -->

</div>
