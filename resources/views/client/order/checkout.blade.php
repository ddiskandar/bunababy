<x-client-layout>

    <div class="relative max-w-screen-sm min-h-screen mx-auto my-0">

        @include('layouts._order-step')

        <div class="space-y-2">
            <div class="px-6 py-4 bg-white">
                @livewire('order.checkout-summary')
            </div>

            @guest
            <div class="px-6 py-4 bg-white">
                @livewire('order.new-user')
            </div>
            @endguest

            @auth
            <div class="px-6 py-4 bg-white">
                @livewire('order.auth-user')
            </div>
            @endauth

        </div>
    </div>

</x-client-layout>
