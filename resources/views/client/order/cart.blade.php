<x-client-layout>

<div class="relative max-w-screen-sm min-h-screen mx-auto my-0">

    @include('layouts._order-step')

    <div class="mt-2 space-y-2">
        @if (! auth()->check() && session()->missing('order.status'))
            <div class="px-6 py-10 text-center bg-white">
                <h4 class="mb-1 font-semibold">
                    Khusus Pelanggan
                </h4>
                <p class="mb-5">
                    Bila sebelumnya sudah pernah pesan treatment, silahkan untuk login.
                </p>
                <a href="{{ route('login') }}">
                    <x-button>
                        Klik untuk Login Sekarang
                    </x-button>
                </a>

            </div>
            <div class="px-6 py-24 text-center text-white bg-green-500">
                <a href="{{ route('order.check') }}" class="inline-flex items-center justify-center py-2 leading-5 border border-transparent rounded " >
                    Klik disini bila sekarang treatment pertama
                </a>
            </div>
        @endif

        @if (session()->has('order.status'))

        <div class="px-6 py-4 bg-white">
            <div class="">
                @include('order._selected-date')
            </div>

            <div class="py-4">
                @livewire('order.select-time')
            </div>
        </div>

        <div class="px-6 py-4 bg-white">
            @livewire('order.select-treatments')
        </div>

        <div class="px-6 py-4 text-white bg-bunababy-100">
            @livewire('order.cart-summary')
        </div>

        @endif

    </div>
</div>
</x-client-layout>
