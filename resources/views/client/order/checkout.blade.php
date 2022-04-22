<x-client-layout>

<div class="container gap-12 px-4 py-4 mx-auto md:py-10 sm:px-12 lg:flex">

    <div class="flex-1 space-y-4 md:mt-0">
        @guest
            @livewire('order.guest-biodata')
        @endguest

        @auth
            @livewire('order.auth-biodata')
        @endauth


    </div>
    <div class="mt-6 lg:w-96 lg:flex-initial lg:mt-0">
        @livewire('order.checkout-summary')
    </div>
</div>

</x-client-layout>
