<x-client-layout>
    <div class="relative max-w-screen-sm min-h-screen mx-auto my-0">
        <div class="sticky top-0 z-20">
            <a href="{{ url()->previous() }}">
                <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                </svg>
            </a>
            <h1 class="flex-1 font-semibold md:text-center">Detail Treatment</h1>
        </div>
    </div>

    <div class="space-y-2">
        <div class="px-6 py-4 bg-white">
            @include('client.order._summary')
        </div>
        <div class="px-6 py-4 bg-white">
            @livewire('order.payments', [$order->id])
        </div>
        <div class="px-6 py-4 bg-white">
            @include('client.order._detail')
        </div>
        <div class="px-6 py-4 bg-white">
            @include('client.order._activity')
        </div>
    </div>
</x-client-layout>
