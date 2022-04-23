<x-client-layout>

<div class="container gap-12 px-4 py-4 mx-auto md:py-10 sm:px-12 md:flex">
    <div class="space-y-4 md:w-80 md:flex-initial">
        <x-panel>
            <div >
                <x-title>Pilih Tempat</x-title>
                @livewire('order.select-place')
            </div>
        </x-panel>

        <x-panel>
            <div>
                <x-title>Pilih Lokasi</x-title>
                @livewire('order.select-location')
                @guest
                <div class="py-2 text-sm">
                    <a class="font-semibold text-bunababy-100" href="{{ route('login') }}">Login</a> untuk lihat alamat anda
                </div>
                @endguest
            </div>
        </x-panel>
    </div>
    <div class="flex-1 mt-6 md:mt-0">
        @livewire('order.list-midwife')
    </div>
</div>

</x-client-layout>
