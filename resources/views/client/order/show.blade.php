<x-client-layout>
    <div class="relative">
        <div class="sticky top-0 z-20 px-4 py-4 text-white shadow bg-bunababy-200 shadow-bunababy-50">
            <div class="flex items-center justify-between max-w-screen-sm mx-auto">
                <a href="{{ route('client.history') }}">
                    <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                    </svg>
                </a>
                <h1 class="flex-1 font-semibold md:text-center">Detail Treatment</h1>
            </div>
        </div>

        <div class="max-w-screen-sm min-h-screen mx-auto my-0 space-y-2">

            <x-section>
                <div class="flex items-center justify-between ">
                    <div >
                        <div class="text-sm font-semibold leading-loose text-bunababy-400">ID Transaksi</div>
                        <div class="flex space-x-2 ">
                            <div class="font-semibold">{{ $order->no_reg }}</div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('order.invoice', $order->no_reg) }}" target="_blank"
                            class="flex items-center w-full py-2 text-sm text-center text-bunababy-200"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <path d="M9 7l1 0"></path>
                                <path d="M9 13l6 0"></path>
                                <path d="M13 17l2 0"></path>
                             </svg>
                            <span class="ml-2">Lihat Invoice</span>
                        </a>
                    </div>
                </div>
            </x-section>
            @if (! $isPaid)
            <x-section>
                @include('client.order._detail')
            </x-section>
            @endif
            <x-section>
                @livewire('client.order.payments', [$order->id])
            </x-section>
            <x-section>
                @include('client.order._activity')
            </x-section>

            <x-section>
                @include('client.order._summary')
            </x-section>
        </div>
    </div>
</x-client-layout>
