<div x-data="{ showDialog: @entangle('showDialog') }"
    class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 border-b md:flex-none md:w-1/3 md:border-0 md:mb-0">
                <h3 class="flex items-center justify-center mb-1 space-x-2 font-semibold md:justify-start">
                    <span>Keluarga</span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Daftar keluarga client
                </p>
            </div>
            <div class="md:w-2/3 md:pl-2">
                <ul class="space-y-4">
                    @forelse ($client->families as $family)
                    <li class="max-w-lg p-6 border rounded shadow-lg border-bunababy-50 shadow-bunababy-50">
                        <div class="flex items-center mb-2">
                            <div  >
                                <div class="text-xl font-semibold">{{ $family->name }}</div>
                            </div>
                        </div>
                        <div class="py-1">
                            <div class="text-sm text-slate-500">
                                Tanggal Lahir
                            </div>
                            <div>
                                {{ $family->birth_date->isoFormat('DD MMMM YYYY') }}
                            </div>
                        </div>
                        <div class="py-1">
                            <div class="text-sm text-slate-500">
                                Hubungan Keluarga
                            </div>
                            <div>
                                {{ $family->type }}
                            </div>
                        </div>
                        <div class="py-2">
                            <button
                                wire:click="showEditDialog({{ $family->id }})"
                                class="text-sm font-semibold text-bunababy-200"
                                >
                                Ubah Data
                            </button>
                        </div>

                    </li>
                    @empty
                    <div class="text-sm text-red-600">Belum ada</div>
                    @endforelse

                </ul>

                <x-secondary-button
                    wire:click="showAddNewFamily"
                    class="mt-2 mr-2"
                    type="button"
                >
                    {{ __('Tambah Keluarga') }}
                </x-secondary-button>

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

                        <x-title>Data Anggota Keluarga</x-title>
                    <div class="h-64 mt-2 space-y-3 overflow-y-auto">
                        <div class="space-y-1">
                            <x-label   for="state.name">Nama</x-label>
                            <x-input wire:model.defer="state.name" class="w-full" type="text" id="state.name" />
                            <x-input-error for="state.name" class="mt-2" />
                        </div>
                        <div class="space-y-1">
                            <x-label   for="state.birth_date">Tanggal lahir</x-label>
                            <x-input wire:model.defer="state.birth_date" class="w-full" type="date" id="state.birth_date" />
                            <x-input-error for="state.birth_date" class="mt-2" />
                        </div>

                        <div class="space-y-1">
                            <x-label   for="state.type">Hubungan keluarga</x-label>
                            <select wire:model.defer="state.type" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.type">
                                <option value="" selected>-- Pilih salah satu</option>
                                <option value="Anak">Anak</option>
                                <option value="Pasangan">Pasangan</option>
                                <option value="Orang Tua">Orang Tua</option>
                                <option value="Saudara Kandung">Saudara Kandung</option>
                                <option value="Kerabat">Kerabat</option>
                                <option value="Teman">Teman</option>
                            </select>
                            <x-input-error for="state.type" class="mt-2" />
                        </div>

                    </div>

                    <div class="py-4">
                        <button
                            type="submit"
                            class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                        >Simpan</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
