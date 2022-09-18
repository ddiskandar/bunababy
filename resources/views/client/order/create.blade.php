<x-client-layout>

    @include('layouts._order-step')

<div>
    <div class="space-y-4">

        <div class="px-6 py-4 my-2 bg-white">
            <div>
                <x-title>Pilih Tempat</x-title>
                @livewire('order.select-place')
            </div>
        </div>

        <div class="px-6 py-4 my-2 bg-white">
            <div>
                @livewire('select-location')
            </div>
        </div>

        <div class="px-6 py-4 my-2 bg-white">
            @if (session('order.place') == 1)
            <div class="flex-1 mt-6 md:mt-0">
                @livewire('order.list-midwife')
            </div>
            @else
            <div class="flex-1 mt-6 md:mt-0">
                @livewire('order.clinic')
            </div>
            @endif
        </div>
    </div>
</div>

</x-client-layout>
