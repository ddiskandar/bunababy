<div>
    <div class="py-4 px-4 md:px-6 flex items-center justify-between sticky shadow shadow-bunababy-50">
        <a href="{{ route('profile') }}">
            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
            </svg>
        </a>
        <h1 class="flex-1 md:text-center">Riwayat Reservasi</h1>
    </div>

    <div class="max-w-xl px-4 py-6 mx-auto ">

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
            class="fixed inset-x-0 w-72 mx-auto bottom-0 right-0 z-60 flex justify-between items-center rounded-full my-4 py-2 px-8 shadow-lg bg-bunababy-200">
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

</div>
