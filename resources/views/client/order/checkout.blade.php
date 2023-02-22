<x-client-layout>
    <x-order-step>
        <div class="space-y-2">
            <div class="px-6 py-4 bg-white">
                @livewire('client.order.checkout-summary')
            </div>

            @guest
            <div class="px-6 py-4 bg-white">
                @livewire('client.order.new-user')
            </div>
            @endguest

            @auth
            <div class="px-6 py-4 bg-white">
                @livewire('client.order.auth-user')
            </div>
            @endauth

        </div>
    </x-order-step>
</x-client-layout>
