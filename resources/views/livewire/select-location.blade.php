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

    <!-- Modal Backdrop -->
    <div
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform opacity-0"
    x-transition:enter-end="transform opacity-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="transform opacity-100"
    x-transition:leave-end="transform opacity-0"
    tabindex="-1"
    role="dialog"
    aria-labelledby="tk-modal-simple"
    x-bind:aria-hidden="!open"
    class="fixed inset-0 p-4 overflow-x-hidden overflow-y-auto bg-gray-900 bg-opacity-75 z-90 lg:p-8"
    >
    <!-- Modal Dialog -->
    <div
        class="fixed inset-x-0 bottom-0 flex flex-col w-full max-w-md mx-auto overflow-hidden bg-white rounded-t shadow-sm sm:rounded sm:static"
        x-show="open"
        x-cloak
        @click.outside="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-125"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-125"
        role="document"
    >
        <div class="flex items-center justify-between w-full px-4 py-4 lg:px-4 bg-gray-50">
            <h3 class="font-medium">
                <span>Pilih lokasi </span>
            </h3>
            <div class="-my-4">
                <button
                type="button"
                class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-600 border border-transparent rounded focus:outline-none hover:text-gray-400 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:text-gray-600"
                x-on:click="open = false"
                >
                <svg class="inline-block w-4 h-4 -mx-1 hi-solid hi-x" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                </button>
            </div>
        </div>
        <div>
            <input
            wire:model="search"
            class="block w-full px-3 py-2 leading-6 border border-gray-200 focus:border-gray-300 focus:outline-0 focus:ring-0 "
            type="text"
            id="tk-form-elements-name"
            placeholder="Cari berdasarkan nama kecamatan" />
        </div>
        <div class="w-full grow">
            <div class="relative max-w-md mx-auto -my-px overflow-auto bg-white dark:bg-slate-800 h-80 ring-1 ring-slate-900/5">
                @foreach ($kabupatens as $kabupaten)
                <div class="relative">
                    <div class="sticky top-0 flex items-center px-4 py-3 text-sm font-semibold text-slate-900 dark:text-slate-200 bg-slate-50/90 dark:bg-slate-700/90 backdrop-blur-sm ring-1 ring-slate-900/10 dark:ring-black/10">
                        {{ $kabupaten->name }}
                    </div>
                    <div class="divide-y dark:divide-slate-200/5">
                        @foreach ($kabupaten->kecamatans as $kecamatan )
                            <div
                                wire:click="setLocation({{ $kecamatan->id }})"
                                x-on:click="open = false"
                                class="flex items-center gap-4 p-4 cursor-pointer">
                                <strong class="text-sm font-medium text-slate-900 dark:text-slate-200">
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
    <!-- END Modal Dialog -->
    </div>
    <!-- END Modal Backdrop -->
</div>
