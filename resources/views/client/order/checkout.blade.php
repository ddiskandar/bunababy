<x-client-layout>
    <x-order-step>
        <x-slot name="title">Order Summary</x-slot>
        @guest
            @livewire('client.order.new-user')
        @else
            @livewire('client.order.checkout-summary')
            @livewire('client.order.auth-user')
        @endguest
    </x-order-step>
</x-client-layout>
