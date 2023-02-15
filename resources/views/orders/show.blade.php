<x-app-layout>

    <div class="space-y-6">
        @livewire('orders.order-detail', [$order->id])

        @if (auth()->user()->isAdmin())
            @livewire('orders.midwife-and-place', [$order->id])
            @livewire('admin.orders.screening', [$order->id])
            @livewire('orders.select-treatments', [$order->id])
            @livewire('orders.payments', [$order->id])
        @endif

        @if (now()->isAfter($order->start_datetime))
            @livewire('orders.set-status', [$order->id])
        @endif

        @if (auth()->user()->isAdmin())
            @livewire('orders.delete', [$order->id])
        @endif
    </div>

</x-app-layout>
