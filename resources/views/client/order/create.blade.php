<x-client-layout>
    <x-order-step>
        <x-section>
            @livewire('client.select-location')
        </x-section>
        <x-section>
            @livewire('client.order.select-place')
        </x-section>
        <x-section>
            @if ((int) session('order.place_type') === \App\Models\Place::TYPE_HOMECARE)
                @livewire('client.order.midwives-availability')
            @else
                @livewire('client.order.clinics-availability')
            @endif
        </x-section>
    </x-order-step>
</x-client-layout>
