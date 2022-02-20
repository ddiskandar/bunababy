<x-client-layout>

<div class="container gap-12 px-4 py-4 mx-auto md:py-10 sm:px-12 lg:flex">

    <div class="flex-1 space-y-4 md:mt-0">
        <x-panel>
            <div class="py-4">
                <div class="flex items-center mb-2 text-bunababy-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                    <div class="ml-2 text-sm font-semibold">
                        Pilihan Hari/Tanggal
                    </div>
                </div>
                <span class="inline-flex items-center px-4 py-1 ml-6 font-semibold leading-5 border rounded-full bg-bunababy-50 border-bunababy-200/50">
                    <span class="w-2 h-2 mr-2 rounded-full bg-bunababy-200"></span>
                    <span class="text-sm text-bunababy-200 ">{{ session('order.date')->isoFormat('dddd, D MMMM G') }}</span>
                </span>

            </div>

            <div class="py-4">
                @livewire('select-time')
            </div>
        </x-panel>

        <div class="py-4">
            @livewire('treatment-catalog')
        </div>

    </div>
    <div class="mt-6 lg:w-96 lg:flex-initial lg:mt-0">
        @livewire('order-summary')
    </div>
</div>

</x-client-layout>
