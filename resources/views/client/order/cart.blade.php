<x-client-layout>
    <x-order-step>
        <div class="mt-2">
            @if (!auth()->check() && session()->missing('order.status'))
                <div class="px-2 space-y-2">
                    <div class="flex flex-col items-center px-6 py-10 text-center bg-white rounded-lg shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-500" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                        </svg>
                        <p class="mb-5">
                            Bila sebelumnya sudah pernah pesan treatment, silahkan untuk login agar pemesanan bisa lebih
                            cepat.
                        </p>
                        <a href="{{ route('login') }}">
                            <x-button>
                                Klik untuk Login Sekarang
                            </x-button>
                        </a>
                    </div>
                    <a href="{{ route('order.check') }}"
                        class="flex flex-col items-center px-6 py-10 text-white bg-green-500 rounded-lg shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 " viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            <path d="M16 11h6m-3 -3v6"></path>
                        </svg>
                        <div
                            class="inline-flex items-center justify-center py-2 leading-5 text-center border border-transparent rounded ">
                            Klik disini bila sekarang treatment pertama
                        </div>
                    </a>
                </div>
            @endif

            @if (session()->has('order.status'))
                <div class="px-6 py-4 bg-white">
                    <div>
                        @include('order._selected-date')
                    </div>

                    <div class="py-4">
                        @livewire('client.order.select-time')
                    </div>
                </div>

                <div class="px-6 py-4 bg-white">
                    @livewire('client.order.select-treatments')
                </div>

                <div class="pb-32 bg-white">
                    @livewire('client.order.cart-summary')
                </div>
            @endif

        </div>
    </x-order-step>
</x-client-layout>
