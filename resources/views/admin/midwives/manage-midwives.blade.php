<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Bidan
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">

                <div class="flex space-x-2">
                    <div class="mt-3 text-center sm:mt-0 sm:text-right w-36">
                        <select wire:model="filterStatus"
                            class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-brand-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="w-16 mt-3 text-center sm:mt-0 sm:text-right">
                        <select wire:model="perPage"
                            class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-brand-100 focus:ring-0 ">
                            <option value="3">3</option>
                            <option value="6" selected>6</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>

                <div>
                    <a href="{{ route('midwives.create') }}" type="button"
                        class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 focus:ring-0 active:bg-white active:border-brand-100">
                        + Tambah Baru
                    </a>

                </div>

            </div>
        </div>
        <div class="w-full p-3 border-b border-gray-100 grow">
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                        class="inline-block w-5 h-5 hi-solid hi-search">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input wire:model="filterSearch"
                    class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-brand-100 focus:ring-0 focus:ring-brand-50"
                    type="search" placeholder="Mencari berdasarkan nama, atau wilayah ..." />
            </div>
        </div>
        <!-- END Card Header -->

        <!-- Card Body -->
        <div class="w-full grow">
            <!-- Responsive Table Container -->
            <div class="min-w-full overflow-x-auto bg-white ">
                <!-- Alternate Responsive Table -->
                <table class="min-w-full text-sm align-middle">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                                ID
                            </th>
                            <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                                Nama
                            </th>
                            <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                                Wilayah
                            </th>
                            <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                                Treatment
                            </th>
                            <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-500">
                                Rating
                            </th>
                            <th class="p-3 text-xs font-medium tracking-wider text-center uppercase text-slate-500">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($midwives as $midwife)
                            <tr @class([
                                'bg-slate-50/30' => $loop->even,
                                'text-slate-400' => !$midwife->active,
                            ])>
                                <td class="p-3 pl-6 align-top whitespace-nowrap ">
                                    <p class="font-semibold">{{ $midwife->id }}</p>
                                </td>
                                <td class="p-3 align-top whitespace-nowrap">
                                    <p class="font-semibold">{{ $midwife->name }}</p>
                                </td>
                                <td class="p-3 align-top ">
                                    <div class="flex flex-wrap gap-2 ">
                                        [{{ $midwife->kecamatans_count }}]
                                        @forelse ($midwife->kecamatans as $kecamatan)
                                            {{ $kecamatan->name . ', ' }}
                                        @empty
                                            <span>Belum ada</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="p-3 align-top ">
                                    <div class="flex flex-wrap gap-2 ">
                                        [{{ $midwife->treatments_count }}]
                                        @forelse ($midwife->treatments as $treatment)
                                            {{ $treatment->name . ', ' }}
                                        @empty
                                            <span>Belum ada</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="p-3 text-center align-top whitespace-nowrap">
                                    <div class="flex items-center">
                                        <svg class="text-yellow-500" width="24" height="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 4.75L13.75 10.25H19.25L14.75 13.75L16.25 19.25L12 15.75L7.75 19.25L9.25 13.75L4.75 10.25H10.25L12 4.75Z">
                                            </path>
                                        </svg>
                                        <div class="font-semibold">
                                            {{ number_format($midwife->reviews->pluck('rate')->average(), 1, ',', '.') }}
                                        </div>
                                        <div> ({{ $midwife->reviews->count() }})</div>
                                    </div>
                                </td>
                                <td class="p-3 text-center align-top whitespace-nowrap">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('midwives.edit', $midwife->id) }}"
                                            class="text-slate-400 hover:text-brand-200">
                                            <x-icon-pencil />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center">
                                    <p class="text-slate-400">Tidak ada yang ditemukan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- END Alternate Responsive Table -->
            </div>
            <!-- END Responsive Table Container -->
        </div>
        <!-- END Card Body -->

        <!-- Card Footer: Pagination -->

        <div class="w-full bg-slate-50">
            {{ $midwives->links() }}
        </div>

        <!-- END Card Footer: Pagination -->

    </div>
    <!-- END Card -->

    <x-dialog wire:model="showDialog">

        <x-title>Data Treatment</x-title>

        <div class="h-64 mt-2 space-y-3 overflow-y-auto">
            <div class="space-y-1">
                <x-label for="state.name">Nama</x-label>
                <x-input wire:model.lazy="state.name" class="w-full" type="text" id="state.name" />
                <x-input-error for="state.name" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.desc">Deskripsi</x-label>
                <x-textarea wire:model.lazy="state.desc" class="w-full" type="text" id="state.desc" />
                <x-input-error for="state.desc" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.price">Harga</x-label>
                <x-input wire:model.lazy="state.price" class="w-full" type="number" id="state.price" />
                <x-input-error for="state.price" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.duration">Durasi</x-label>
                <x-input wire:model.lazy="state.duration" class="w-full" type="number" id="state.duration" />
                <x-input-error for="state.duration" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.category_id">Kategory</x-label>
                <select wire:model.lazy="state.category_id"
                    class="w-full rounded-md border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75"
                    type="text" id="state.category_id">
                    <option value="" selected>-- Pilih salah satu</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.category_id" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.order">Urutan</x-label>
                <x-input wire:model.lazy="state.order" class="w-full" type="number" id="state.order" />
                <x-input-error for="state.order" class="mt-2" />
            </div>
            <div class="py-4 space-y-1">
                <div class="inline-flex items-center ml-2">
                    <div class="flex items-center h-5 ">
                        <input type="checkbox" wire:model.lazy="state.active" name="state.active"
                            class="w-12 transition-all duration-150 ease-out rounded-full cursor-pointer form-switch h-7 text-brand-200 focus:ring focus:ring-brand-200 focus:ring-opacity-50">
                    </div>
                    <div class="ml-2 ">
                        <x-label for="state.active">Aktif</x-label>
                    </div>
                </div>
            </div>

        </div>

        <div class="py-4">
            <button wire:click="save" type="button"
                class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-brand-200 shadow-brand-100/50">Simpan</button>
        </div>

    </x-dialog>

</div>
