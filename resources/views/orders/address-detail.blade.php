<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm"
    x-data="{ showDialog: @entangle('showDialog') }"
    >
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 border-b md:flex-none md:w-1/3 md:border-0 md:mb-0">
                <h3 class="font-semibold">
                    <span>Tempat Treatment</span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Tempat dan Alamat untuk treatment
                </p>
            </div>
            <div class="md:w-2/3 md:pl-2">
                <form onsubmit="return false;" enctype="multipart/form-data" class="space-y-6">
                <div class="space-y-1">
                    <x-label for="place">Tempat</x-label>
                    <select wire:model="place" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="place">
                        <option value="" selected>-- Pilih salah satu</option>
                        <option value="1">Homecare</option>
                        <option value="2">Klinik</option>
                    </select>
                    <x-input-error for="place" class="mt-2" />
                </div>

                @if ($place == 1)
                <div class="space-y-1">
                    <div  >
                        <x-label for="role" value="{{ __('Alamat') }}" />
                        <x-input-error for="role" class="mt-2" />

                        <div class="relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer">
                            @foreach ($addresses as $index => $address)
                                <button type="button" class="relative px-4 py-3 inline-flex w-full rounded-lg {{ $index > 0 ? 'border-t border-gray-200 rounded-t-none' : '' }} {{ ! $loop->last ? 'rounded-b-none' : '' }}"
                                                wire:click="$set('selectedAddressId', '{{ $address->id }}')">
                                    <div class="{{ isset($selectedAddressId) && $selectedAddressId != $address->id ? 'opacity-50' : '' }}">
                                        <!-- Role Name -->
                                        <div class="flex items-center">
                                            <div class="text-sm capitalize text-gray-600 {{ $selectedAddressId == $address->id ? 'font-semibold' : '' }}">
                                                {{ $address->label }}
                                            </div>

                                            @if ($selectedAddressId == $address->id)
                                                <svg class="w-5 h-5 ml-2 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                        </div>

                                        <!-- Role Description -->
                                        <div class="mt-2 text-sm text-left text-gray-600">
                                            {{ $address->full_address }}
                                            @if ($selectedAddressId == $address->id)
                                            <div class="text-sm py-3 font-semibold text-bunababy-200"
                                                wire:click="showEditDialog({{ $address->id }})"
                                            >
                                                Ubah Alamat
                                            </div>
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

                </form>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div
    x-show="showDialog"
    style="display: none !important;"
    class="fixed inset-0 overflow-y-auto z-90 " aria-labelledby="modal-title" role="dialog" aria-modal="true"
    >
        <div
            x-show = "showDialog"
            class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div
                x-show="showDialog"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                tabindex="-1"
                role="dialog"
                aria-labelledby="tk-modal-simple"
                x-bind:aria-hidden="!showDialog"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true">
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                x-show="showDialog"
                x-trap.noscroll="showDialog"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative inline-block w-full text-left align-bottom transition-all transform sm:mb-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
                <button
                    x-on:click="showDialog = false"
                    class="absolute z-30 p-2 bg-white rounded-full -top-12 right-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 rotate-45 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>

                <div class="px-4 pt-5 pb-4 overflow-hidden bg-white rounded-lg shadow-xl sm:p-6 sm:pb-4">
                    <form wire:submit.prevent="save">
                        <x-title>Alamat</x-title>
                        <div class="h-64 mt-2 space-y-3 overflow-y-auto">
                            <div class="space-y-1">
                                <x-label   for="state.label">Label</x-label>
                                <x-input wire:model.defer="state.label" class="w-full" type="text" id="state.label" placeholder="Contoh: Rumah, Kantor" />
                                <x-input-error for="state.label" class="mt-2" />
                            </div>
                            <div class="space-y-1">
                                <x-label   for="state.address">Kampung/Jalan</x-label>
                                <x-input wire:model.defer="state.address" class="w-full" type="text" id="state.address" />
                                <x-input-error for="state.address" class="mt-2" />
                            </div>
                            <div class="space-y-1">
                                <x-label   for="state.rt">Rt</x-label>
                                <x-input wire:model.defer="state.rt" class="w-full" type="number" id="state.rt" />
                                <x-input-error for="state.rt" class="mt-2" />
                            </div>
                            <div class="space-y-1">
                                <x-label   for="state.rw">Rw</x-label>
                                <x-input wire:model.defer="state.rw" class="w-full" type="number" id="state.rw" />
                                <x-input-error for="state.rw" class="mt-2" />
                            </div>
                            <div class="space-y-1">
                                <x-label   for="state.desa">Desa</x-label>
                                <x-input wire:model.defer="state.desa" class="w-full" type="text" id="state.desa" />
                                <x-input-error for="state.desa" class="mt-2" />
                            </div>

                            <div class="space-y-1">
                                <x-label   for="state.kecamatan_id">Kecamatan</x-label>
                                <select @if ($dialogEditMode) disabled @endif wire:model.defer="state.kecamatan_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.kecamatan_id">
                                    <option value="" selected>-- Pilih salah satu</option>
                                    @foreach (\DB::table('kecamatans')->orderBy('name')->get(['id', 'name']) as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="state.kecamatan_id" class="mt-2" />
                            </div>

                            <div class="space-y-1">
                                <x-label   for="state.note">Catatan Petunjuk</x-label>
                                <x-textarea wire:model.defer="state.note" class="w-full" type="text" id="state.note" placeholder="Patokan alamat atau petunjuk menuju lokasi" />
                                <x-input-error for="state.note" class="mt-2" />
                            </div>

                        </div>

                        <div class="py-4">
                            <button type="submit"
                                class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                            >Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
