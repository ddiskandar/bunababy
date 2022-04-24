<x-client-layout>
    <div class="sticky flex items-center justify-between px-4 py-4 shadow md:px-6 shadow-bunababy-50">
        <a href="{{ url()->previous() }}">
            <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
            </svg>
        </a>
        <h1 class="flex-1 font-semibold md:text-center">Detail Treatment</h1>
    </div>
    <div class="container flex flex-col gap-8 px-4 py-6 mx-auto sm:px-12 lg:flex-row">
        <div class="flex-1 order-2 space-y-6 lg:order-1 md:mt-0">
            @include('client.order._summary')
            @livewire('order.payments', [$order->id])
        </div>
        <div class="order-1 mt-6 space-y-8 lg:order-2 lg:w-96 lg:flex-initial lg:mt-0">
            @include('client.order._detail')
            @include('client.order._activity')
        </div>
    </div>
</x-client-layout>
