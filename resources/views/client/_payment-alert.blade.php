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
            class="sticky inset-x-0 p-3 bg-red-600 shadow-lg top-[67px] z-60 px-6">
            <div class="flex items-center justify-between">
                <div class="inline-flex items-center text-white">
                    <svg class="inline-block w-8 h-8 flex-none opacity-50" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.9522 16.3536L10.2152 5.85658C10.9531 4.38481 13.0539 4.3852 13.7913 5.85723L19.0495 16.3543C19.7156 17.6841 18.7487 19.25 17.2613 19.25H6.74007C5.25234 19.25 4.2854 17.6835 4.9522 16.3536Z"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10V12"></path>
                        <circle cx="12" cy="16" r="1" fill="currentColor"></circle>
                    </svg>
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
