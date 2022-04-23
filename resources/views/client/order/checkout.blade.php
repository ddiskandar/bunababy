<x-client-layout>

<div class="container gap-12 px-4 py-4 mx-auto md:py-10 sm:px-12 flex flex-col lg:flex-row">
    <div class="flex-1 space-y-4 md:mt-0 order-2 lg:order-1">
        @guest
            @livewire('order.new-user')
        @endguest

        @auth
            @livewire('order.auth-user')
        @endauth
    </div>

    <div class="mt-6 lg:w-96 lg:flex-initial lg:mt-0 order-1 lg:order-2">
        @livewire('order.checkout-summary')
    </div>
</div>

</x-client-layout>
