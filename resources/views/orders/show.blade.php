<x-app-layout>

    <div class="space-y-6">
        @livewire('admin.orders.order-detail', [$order->id])

        @if (auth()->user()->isAdmin())
            @livewire('admin.orders.edit-order', [$order->id])
            @livewire('admin.orders.select-treatments', [$order->id])
            @livewire('admin.orders.payments', [$order->id])
            @livewire('admin.orders.screening', [$order->id])
        @endif

        @if (now()->isAfter($order->startDateTime))
            @livewire('admin.orders.set-status', [$order->id])
        @endif

        @if (auth()->user()->isAdmin())
            @livewire('admin.orders.delete', [$order->id])
        @endif
    </div>

</x-app-layout>
