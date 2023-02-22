<x-client-layout>
    <x-order-step>
        <x-section>
            <x-title>Pilih Tempat</x-title>
            @livewire('client.order.select-place')
        </x-section>

        @if (session('order.place') == 1)
            <x-section>
                @livewire('client.select-location')
            </x-section>
        @endif

        <x-section>
            @if (session('order.place') == 1)
            <div class="flex-1 mt-6 md:mt-0">
                @livewire('client.order.list-midwife')
            </div>
            @else
            <div class="flex-1 mt-6 md:mt-0">
                @livewire('client.order.clinic')
            </div>
            @endif
        </x-section>
    </x-order-step>
</x-client-layout>
