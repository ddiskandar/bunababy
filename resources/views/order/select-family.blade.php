<div x-data="{ add : @entangle('showAddNewFamily') }">
    @if (session()->has('order.families'))
        <nav class="overflow-hidden bg-white border border-gray-200 divide-y divide-gray-200 rounded">
            @foreach ($families as $family)
                <button
                    wire:click="selectFamily({{ $family['id'] }})"
                    class="flex items-center justify-between w-full p-4 text-gray-700 hover:text-gray-700 hover:bg-bunababy-50/20 active:bg-white" >
                    <div class="flex items-center space-x-4">
                        <img class="object-cover w-12 h-12 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($family['name']) }}&color=7F9CF5&background=EBF4FF" alt="{{ $family['name'] }}" >
                        <div class="text-left">
                        <p class="text-sm font-semibold">
                            {{ $family['name'] }}
                        </p>
                        <p class="text-sm font-medium text-gray-500">
                            {{ $family['type']}}
                        </p>
                        </div>
                    </div>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 opacity-50 hi-solid hi-chevron-right"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                </button>
            @endforeach
        </nav>
        <div
            x-show = "! add"
            class="py-4 text-sm text-slate-400">
            Belum ada di daftar? <button x-on:click="add = true" class="font-semibold text-bunababy-200">Tambah profil keluarga</button>
        </div>
    @else
    <div
        x-init="add = true"
        class="flex flex-col items-center py-6">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
            </svg>
        </div>
        <div class="font-semibold leading-loose">Tambah Pofil </div>
        <div class="text-sm text-slate-400">Belum ada yang tersimpan, tambahkan profil anda</div>
    </div>
    @endif

    <div
        x-show="add"
        @if (session()->has('order.families'))
        x-on:click.outside="add = false"
        @endif
        class="items-center justify-between py-4 md:flex md:space-x-2">
        <div class="w-full">
            <label for="price" class="block text-sm font-medium text-gray-700 sr-only">Nama</label>
            <div class="relative rounded-md shadow-sm">
            <input
                wire:model.lazy="name"
                type="text"
                name="price"
                id="price"
                class="block w-full pr-12 text-sm border-gray-300 rounded-md focus:ring-bunababy-100 focus:border-bunababy-100"
                placeholder="Nama">
            @if (session()->has('order.families'))
                <div class="absolute inset-y-0 right-0 flex items-center">
                    <label for="currency" class="sr-only">Hubungan Keluarga</label>
                    <select
                        wire:model="type"
                        id="currency"
                        name="currency"
                        class="h-full py-0 pl-2 text-sm text-gray-500 bg-transparent border-transparent rounded-md focus:ring-bunababy-100 focus:border-bunababy-100 pr-7">
                        <option value="Anak" selected>Anak</option>
                        <option value="Pasangan">Pasangan</option>
                        <option value="Orang tua">Orang tua</option>
                        <option value="Saudara Kandung">Saudara Kandung</option>
                        <option value="Kerabat">Kerabat</option>
                        <option value="Teman">Teman</option>
                    </select>
                </div>
            @endif
            </div>
        </div>

        <div class="mt-2 md:mt-0">
            <!-- Button (small) -->
            <button
                wire:click="addFamily()"
                type="button"
                class="w-full px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-bunababy-200 hover:bg-bunababy-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bunababy-200 ">
            Tambah
            </button>
            <!-- END Button (small) -->
        </div>
    </div>
</div>
