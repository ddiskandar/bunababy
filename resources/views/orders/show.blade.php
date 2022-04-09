<x-app-layout>

    <div class="space-y-6">
        @livewire('orders.order-detail', [$order->id])

        @if (auth()->user()->isAdmin())
            @livewire('orders.midwife-time', [$order->id])
            @livewire('orders.address-detail', [$order->id])
            @livewire('orders.select-treatments', [$order->id])
            @livewire('orders.payments', [$order->id])
        @endif

        @livewire('orders.set-status', [$order->id])
    </div>

</x-app-layout>
