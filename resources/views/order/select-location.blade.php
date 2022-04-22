<div x-data="{ open: false }">
    <!-- Modal Toggle Button -->
    <button
        type="button"
        class="flex items-center justify-between w-full py-4 "
        x-on:click="open = ! open"
    >
        <div class="flex items-center ">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-bunababy-200" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
            </svg>
            <span class="ml-2">{{ $kecamatan }}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-600" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>

    </button>
    <!-- END Modal Toggle Button -->

    <!-- Modal -->
    <div
    x-show="open"
    style="display: none !important;"
    class="fixed z-30 inset-0 overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true"
    >
        <div
            x-show = "open"
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                tabindex="-1"
                role="dialog"
                aria-labelledby="tk-modal-simple"
                x-bind:aria-hidden="!open"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                x-show="open"
                x-trap.noscroll="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom relative w-full text-left transform transition-all sm:mb-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
                <button
                    x-on:click="open = false"
                    class="bg-white p-2 rounded-full absolute -top-12 right-2 z-30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-200 rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 overflow-hidden rounded-lg shadow-xl">
                    <x-title>Pilih Lokasi</x-title>
                    <div class="py-3">
                        <input
                        wire:model="search"
                        x-ref="input"
                        class="block w-full px-3 py-2 text-sm leading-6 border rounded-full border-bunababy-50 focus:border-bunababy-50 focus:outline-0 focus:ring-0 "
                        type="text"
                        id="tk-form-elements-name"
                        placeholder="Cari berdasarkan nama kecamatan" />
                    </div>

                    <div class="flex flex-col border divide-y overflow-hidden border-slate-100">
                        <div class="relative w-full mx-auto -my-px overflow-auto bg-white h-80 ring-1 ring-slate-900/5">
                            @foreach ($kabupatens as $kabupaten)
                            <div class="relative">
                                <div class="sticky top-0 flex items-center px-4 py-3 text-sm font-semibold text-slate-900  bg-slate-50/90  backdrop-blur-sm ring-1 ring-slate-900/10 ">
                                    {{ $kabupaten->name }}
                                </div>
                                <div class="divide-y ">
                                    @foreach ($kabupaten->kecamatans as $kecamatan )
                                        <div
                                            wire:click="setLocation({{ $kecamatan->id }})"
                                            x-on:click="open = false"
                                            class="flex items-center gap-4 p-4 cursor-pointer">
                                            <strong class="text-sm font-medium text-slate-900 ">
                                                {{ $kecamatan->name }}
                                            </strong>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
