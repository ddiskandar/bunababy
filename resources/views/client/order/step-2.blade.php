<x-client-layout>

<div class="container gap-12 px-4 py-4 mx-auto md:py-10 sm:px-12 lg:flex">

    <div class="flex-1 space-y-4 md:mt-0">
        <x-panel>
            <div class="py-4">
                @include('client.order._selected-date')
            </div>

            <div class="py-4">
                @livewire('order.select-time')
            </div>
        </x-panel>

        <div class="py-4">
            @livewire('order.select-treatments')
        </div>

    </div>
    <div class="mt-6 lg:w-96 lg:flex-initial lg:mt-0">
        @livewire('order.checkout')
    </div>
</div>

</x-client-layout>
