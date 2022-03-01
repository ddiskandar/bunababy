<x-panel>
    <div class="py-6">
        <div class="flex items-center mb-2 text-bunababy-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            <div class="ml-2 text-sm font-semibold">
                Data Lengkap Pemesan
            </div>
        </div>
        <div class="ml-8 grid grid-cols-6 gap-6">
            <!-- Nama Lengkap -->
            <div class="col-span-6">
                <x-label for="name" :value="__('Nama Lengkap')" />
                <div>{{ auth()->user()->name }}</div>
                <div>{{ auth()->user()->phone }}</div>
                <div>{{ $fullAddress }}</div>
            </div>
        </div>

    </div>


</x-panel>
