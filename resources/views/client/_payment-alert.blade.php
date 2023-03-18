@if (( isset($reservation) && ! $reservation->isPaid() ) || session('status'))
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
            class="sticky inset-x-0 py-4 bg-blue-600 shadow-lg top-[67px] z-60 px-4">
            <div class="flex items-start justify-between">
                <div class="inline-flex items-start text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-none inline-block w-6 h-6" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                     </svg>
                    <p class="ml-2 text-sm">
                        Anda mempunyai reservasi aktif yang belum lunas dibayar, bila treatment sudah selesai, silahkan untuk segera melunasi sisa pembayaran. <a href="{{ route('order.show', $reservation->no_reg) }}" class="underline hover:opacity-75">bayar sekarang</a>
                    </p>
                </div>
                <div class="flex items-center ml-2">
                    <button
                        x-on:click="show = false"
                        type="button" class="inline-flex items-center justify-center p-1 text-white rounded opacity-75 focus:outline-none hover:opacity-100 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:opacity-75">
                        <svg class="inline-block w-4 h-4 hi-outline hi-x" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- END Banner (top fixed) -->
    @endif
