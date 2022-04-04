<x-app-layout>

    @livewire('orders.client-detail', [$order->id])
    @livewire('orders.address-detail', [$order->id])

</x-app-layout>
