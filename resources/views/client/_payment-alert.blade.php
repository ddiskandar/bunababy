@if (( isset($reservation) AND ! $reservation->isPaid() ) OR session('status'))
        <!-- Banner (top fixed) -->
        <div
            x-data="{ show: true }" x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-8"
            style="display: none !important"
            class="sticky inset-x-0 p-3 bg-red-600 shadow-lg top-[67px] z-60 sm:py-5 sm:px-8">
            <div class="flex items-center justify-between container mx-auto sm:px-12">
                <div class="inline-flex items-center text-white">
                    <svg class="hi-solid hi-check-circle inline-block w-5 h-5 flex-none opacity-50" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <p class="text-sm ml-2">
                        Anda mempunyai reservasi aktif yang belum lunas dibayar, <a href="{{ route('order.show', $reservation->no_reg) }}" class="underline hover:opacity-75">bayar sekarang</a>
                    </p>
                </div>
                <div class="flex items-center ml-2">
                    <button
                        x-on:click="show = false"
                        type="button" class="inline-flex items-center justify-center p-1 text-white rounded opacity-75 focus:outline-none hover:opacity-100 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:opacity-75">
                        <svg class="inline-block w-6 h-6 hi-outline hi-x" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- END Banner (top fixed) -->
    @endif
