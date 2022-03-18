<div x-data="{ showDialog: @entangle('showDialog') }">
    <div class="py-4 px-4 md:px-6 flex items-center justify-between sticky shadow shadow-bunababy-50">
        <a href="{{ route('profile') }}">
            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
            </svg>
        </a>
        <h1 class="flex-1 font-semibold md:text-center">Daftar Anggota Keluarga</h1>
        <a
            wire:click="addNewFamily"
            href="#"
            class="text-sm text-bunababy-100"
            >
            Tambah Anggota
        </a>
    </div>

    <div class="max-w-xl px-4 py-6 mx-auto ">
        <ul class="space-y-4">
            @forelse ( auth()->user()->families as $family)
            <li class="max-w-lg p-6 border rounded shadow-lg border-bunababy-50 shadow-bunababy-50">
                <div class="flex items-center mb-2">
                    <div class="">
                        <div class="text-xl font-semibold">{{ $family->name }}</div>
                    </div>
                </div>
                <div>
                    {{ $family->birth_date }}
                </div>
                <div>
                    {{ $family->type }}
                </div>
                <div class="py-2">
                    <a
                        wire:click="showEditDialog({{ $family->id }})"
                        href="#"
                        class="text-sm text-bunababy-100"
                        >
                        Ubah Data
                    </a>
                </div>

            </li>
            @empty

            @endforelse

        </ul>
    </div>

    <!-- Banner (bottom bubble) -->
    <div
        x-data="{ show: @entangle('successMessage') }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-8"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-8"
        style="display: none !important"
        class="fixed inset-x-0 w-72 mx-auto bottom-0 right-0 z-60 flex justify-between items-center rounded-full mb-24 py-2 px-8 shadow-lg bg-bunababy-200">
        <div class="inline-flex items-center text-pink-100 text-sm">
            <p>
                Data berhasil diperbaharui
            </p>
        </div>
        <div class="flex items-center ml-2">
            <button
                wire:click="$set('successMessage', false)"
                type="button" class="p-1 rounded inline-flex justify-center items-center focus:outline-none text-white opacity-75 hover:opacity-100  active:opacity-75">
                <svg class="hi-outline hi-x inline-block w-4 h-4" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
    <!-- END Banner (bottom bubble) -->

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
                    <x-title>Ubah Data Anggota Keluarga</x-title>
                    <div class="h-64 mt-2 space-y-3 overflow-y-auto">
                        <div class="space-y-1">
                            <x-label class="" for="state.name">Nama</x-label>
                            <x-input wire:model="state.name" class="w-full" type="text" id="state.name" />
                            <x-input-error for="state.name" class="mt-2" />
                        </div>
                        <div class="space-y-1">
                            <x-label class="" for="state.birth_date">Tanggal lahir</x-label>
                            <x-input wire:model="state.birth_date" class="w-full" type="date" id="state.birth_date" />
                            <x-input-error for="state.birth_date" class="mt-2" />
                        </div>

                        <div class="space-y-1">
                            <x-label class="" for="state.type">Hubungan keluarga</x-label>
                            <select wire:model="state.type" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.type">
                                <option value="" selected>-- Pilih salah satu</option>
                                <option value="Diri Sendiri">Diri Sendiri</option>
                                <option value="Anak">Anak</option>
                                <option value="Pasangan">Pasangan</option>
                                <option value="Orang tua">Orang tua</option>
                                <option value="Saudara Kandung">Saudara Kandung</option>
                                <option value="Kerabat">Kerabat</option>
                                <option value="Teman">Teman</option>
                            </select>
                            <x-input-error for="state.type" class="mt-2" />
                        </div>

                    </div>

                    <div class="py-4">
                        <button
                            wire:click="save"
                            type="button"
                            class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                        >Simpan</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
