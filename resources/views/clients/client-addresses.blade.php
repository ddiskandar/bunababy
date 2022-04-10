<div class="space-y-4">

    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="mb-4 md:flex-none md:w-1/3">
            <h3 class="font-semibold">
                <span>Alamat</span>
            </h3>
            <p class="mb-5 text-sm text-gray-500">
                Alamat Client
            </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 space-y-6 lg:p-6 grow">

            <div class="space-y-1">
                <div class="">
                    <div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                        @forelse ($addresses as $index => $address)
                            <div class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 {{ $index > 0 ? 'border-t border-gray-200 rounded-t-none' : '' }} {{ ! $loop->last ? 'rounded-b-none' : '' }}">
                                <div class="w-full">
                                    <!-- Role Name -->
                                    <div class="flex items-center justify-between ">
                                        <div class="flex items-center">
                                            <div
                                                class="text-sm font-semibold capitalize text-gray-600 {{ $address->is_main ? 'font-semibold' : '' }}"
                                                wire:click="setAddressAsMain({{ $address->id }})"
                                                >
                                                {{ $address->label }}
                                            </div>

                                            @if ($address->is_main)
                                                <svg class="w-5 h-5 ml-2 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                        </div>
                                        <div wire:click="showEditAddressDialog({{ $address->id }})">
                                            <x-button-icon>
                                                <x-icon-pencil-alt/>
                                            </x-button-icon>
                                        </div>
                                    </div>

                                    <!-- Role Description -->
                                    <div class="text-sm text-left text-gray-600 ">
                                        {{ $address->full_address }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-3 text-sm">Belum ada alamat</div>
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

        </div>
        <!-- Card Body: User Profile -->
        </div>
        <!-- Card: User Profile -->
    </div>
    <!-- END User Profile -->

    <x-notification wire:model="successMessage">
        Data berhasil disimpan
    </x-notification>

    <x-dialog wire:model="showDialog">

        <x-title>Data Treatment</x-title>
        <div class="h-64 mt-2 space-y-3 overflow-y-auto">
            <div class="space-y-1">
                <x-label class="" for="state.label">Label</x-label>
                <x-input wire:model.defer="state.label" class="w-full" type="text" id="state.label" />
                <x-input-error for="state.label" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.address">Kampung/ Jalan</x-label>
                <x-input wire:model.defer="state.address" class="w-full" type="text" id="state.address" />
                <x-input-error for="state.address" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.rt">Rt</x-label>
                <x-input wire:model.defer="state.rt" class="w-full" type="number" id="state.rt" />
                <x-input-error for="state.rt" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.rw">Rw</x-label>
                <x-input wire:model.defer="state.rw" class="w-full" type="number" id="state.rw" />
                <x-input-error for="state.rw" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.desa">Desa</x-label>
                <x-input wire:model.defer="state.desa" class="w-full" type="text" id="state.desa" />
                <x-input-error for="state.desa" class="mt-2" />
            </div>

            <div class="space-y-1">
                <x-label class="" for="state.kecamatan_id">Kecamatan</x-label>
                <select wire:model.defer="state.kecamatan_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.kecamatan_id">
                    <option value="" selected>-- Pilih salah satu</option>
                    @foreach (\DB::table('kecamatans')->orderBy('name')->get(['id', 'name']) as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.kecamatan_id" class="mt-2" />
            </div>

            <div class="space-y-1">
                <x-label class="" for="state.note">Catatan</x-label>
                <x-textarea wire:model.defer="state.note" class="w-full" type="text" id="state.note" />
                <x-input-error for="state.note" class="mt-2" />
            </div>

        </div>

        <div class="py-4">
            <button
                wire:click="save"
                type="button"
                class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
            >Simpan</button>
        </div>

    </x-dialog>

</div>
