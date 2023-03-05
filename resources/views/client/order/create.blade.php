<x-client-layout>
    <x-order-step>
        <x-section>
            @livewire('client.select-location')
        </x-section>
        <x-section>
            @livewire('client.order.select-place')
        </x-section>
        <x-section>
            <div class="flex-1 mt-6 md:mt-0">
                @if (session('order.place_type') === \App\Models\Place::TYPE_HOMECARE)
                    @livewire('client.order.midwives-availability')
                @else
                    @livewire('client.order.clinics-availability')
                @endif
            </div>
        </x-section>
    </x-order-step>
</x-client-layout>
