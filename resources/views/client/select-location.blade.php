<div x-data="{ open: false }">
    <!-- Modal Toggle Button -->
    <x-title>Lokasi Anda</x-title>

    <button
        type="button"
        class="flex items-center justify-between w-full py-4 "
        x-on:click="open = ! open"
        wire:click="load"
    >

        <div class="flex items-center ">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-bunababy-200" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="12" cy="11" r="3"></circle>
                <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
             </svg>
            <span class="ml-2">{{ $kecamatan }}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5  text-bunababy-200" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>

    </button>
    <!-- END Modal Toggle Button -->

    <!-- Modal -->
    <div
    x-show="open"
    style="display: none !important;"
    class="fixed inset-0 z-30 overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true"
    >
        <div
            x-show = "open"
            class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
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
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true">
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
                class="relative inline-block w-full text-left align-bottom transition-all transform sm:mb-8 sm:align-middle sm:max-w-lg sm:w-full"
            >
                <button
                    x-on:click="open = false"
                    class="absolute z-30 p-2 bg-white rounded-full -top-12 right-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 rotate-45 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>

                <div class="px-4 pt-5 pb-4 overflow-hidden bg-white rounded-lg shadow-xl sm:p-6 sm:pb-4">
                    @guest
                    <div class="py-2 text-sm">
                        <a class="font-semibold text-bunababy-100" href="{{ route('login') }}">Login</a> untuk lihat alamat anda
                    </div>
                    @endguest

                    <div class="py-3">
                        <input
                        wire:model="search"
                        x-ref="input"
                        class="block w-full px-3 py-2 text-sm leading-6 border rounded-full border-bunababy-50 focus:border-bunababy-50 focus:outline-0 focus:ring-0 "
                        type="text"
                        id="tk-form-elements-name"
                        placeholder="Cari berdasarkan nama kecamatan" />
                    </div>

                    <div class="flex flex-col overflow-hidden border divide-y border-slate-100">
                        <div class="relative w-full mx-auto -my-px overflow-auto bg-white h-80 ring-1 ring-slate-900/5">
                            @foreach ($kabupatens as $kabupaten)
                            <div class="relative">
                                <div class="sticky top-0 flex items-center px-4 py-3 text-sm font-semibold text-slate-900 bg-slate-50/90 backdrop-blur-sm ring-1 ring-slate-900/10 ">
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
