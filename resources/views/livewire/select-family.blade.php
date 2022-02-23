<div x-data="{ add : @entangle('showAddFamily') }">
    @if (session()->has('order.family'))
        <nav class="border border-gray-200 rounded bg-white divide-y divide-gray-200 overflow-hidden">
            @foreach ($families as $family)
                <a class="p-4 flex justify-between items-center text-gray-700 hover:text-gray-700 hover:bg-bunababy-50/20 active:bg-white" href="javascript:void(0)">
                    <div class="flex items-center space-x-4">
                        <img src="https://source.unsplash.com/iFgRcqHznqg/160x160" alt="User Avatar" class="inline-block w-10 h-10 rounded-full">
                        <div class="text-left">
                        <p class="font-semibold text-sm">
                            {{ $family['name'] }}
                        </p>
                        <p class="font-medium text-sm text-gray-500">
                            {{ $family['type']}}
                        </p>
                        </div>
                    </div>
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-chevron-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                </a>
            @endforeach
        </nav>
        <div
            x-show = "! add"
            x-on:click="add = true"
            class="text-sm text-slate-400 py-4">
            Belum ada di daftar? <button class="text-bunababy-200 font-semibold">Tambah profil keluarga</button>
        </div>
    @else
    <div
        x-init="add = true"
        class="py-6 flex flex-col items-center">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-bunababy-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
            </svg>
        </div>
        <div class="font-semibold leading-loose">Tambah Pofil </div>
        <div class="text-sm text-slate-400">Belum ada profil yang tersimpan</div>
    </div>
    @endif

    <div
        x-show="add"
        class="md:flex items-center md:space-x-2 justify-between py-4">
        <div class="w-full">
            <label for="price" class="block text-sm font-medium sr-only text-gray-700">Nama</label>
            <div class="relative rounded-md shadow-sm">
            <input
                wire:model.lazy="name"
                type="text"
                name="price"
                id="price"
                class="focus:ring-bunababy-100 focus:border-bunababy-100 block w-full  pr-12 text-sm border-gray-300 rounded-md"
                placeholder="Nama">
            @if (session()->has('order.family'))
                <div class="absolute inset-y-0 right-0 flex items-center">
                    <label for="currency" class="sr-only">Hubungan Keluarga</label>
                    <select
                        wire:model="type"
                        id="currency"
                        name="currency"
                        class="focus:ring-bunababy-100 focus:border-bunababy-100 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 text-sm rounded-md">
                        <option value="Anak">Anak</option>
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
                class="rounded-md w-full border border-transparent shadow-sm px-4 py-2 bg-bunababy-200 text-sm font-medium text-white hover:bg-bunababy-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bunababy-200 ">
            Tambah
            </button>
            <!-- END Button (small) -->
        </div>
    </div>
</div>
