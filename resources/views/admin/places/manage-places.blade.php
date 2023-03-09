<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Tempat
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">

                <div class="flex space-x-2">

                    <div class=" w-36">
                        <select wire:model="filterStatus" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="w-16 ">
                        <select wire:model="perPage" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="3" selected="selected">3</option>
                            <option value="8">8</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>

                <div>
                    <button wire:click="showAddNewPlaceDialog" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 focus:ring-0 active:bg-white active:border-bunababy-100">
                        + Tambah Klinik
                    </button>

                </div>

            </div>
        </div>
        <div class="w-full p-3 border-b border-gray-100 grow">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="search" placeholder="Mencari berdasarkan nama, deskripsi, harga, atau durasi ..." />
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
                        <th class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Nama
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Deskripsi
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Tipe
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-center uppercase text-slate-400 ">
                            Urutan
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-center uppercase text-slate-400">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($places as $place)
                        <tr @class([
                            '',
                            'bg-slate-50/30' => $loop->even,
                            'text-slate-400' => ! $place->active,
                        ])>
                            <td class="p-3 pl-6 align-top whitespace-nowrap">
                                <p class="font-semibold">{{ $place->name }}</p>
                            </td>
                            <td class="p-3 align-top ">
                                <p>{{ $place->desc }}</p>
                            </td>
                            <td class="p-3 align-top whitespace-nowrap">
                                <p>{{ $place->getTypeString() }}</p>
                            </td>
                            <td class="p-3 text-center align-top whitespace-nowrap">
                                <p>{{ $place->order }}</p>
                            </td>
                            <td class="p-3 text-center align-top whitespace-nowrap">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('places.edit', $place->id) }}" class="text-slate-400 hover:text-bunababy-200">
                                        <x-icon-pencil/>
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

        <div class="w-full p-4 bg-slate-50">
            {{ $places->links() }}
        </div>

        <!-- END Card Footer: Pagination -->

    </div>
    <!-- END Card -->


    <x-dialog wire:model="showDialog">
        <form wire:submit.prevent="save">
            <x-title>Tambah Klinik</x-title>

            <div class="h-64 px-1 mt-2 space-y-3 overflow-y-auto">
                <div class="space-y-1">
                    <x-label for="state.name">Nama</x-label>
                    <x-input wire:model.lazy="state.name" class="w-full" type="text" id="state.name" />
                    <x-input-error for="state.name" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label for="state.desc">Deskripsi</x-label>
                    <x-textarea wire:model.lazy="state.desc" class="w-full" rows=4 type="text" id="state.desc" />
                    <x-input-error for="state.desc" class="mt-2" />
                </div>
            </div>

            <div class="py-4">
                <x-button-on-modal/>
            </div>
        </form>
    </x-dialog>

</div>
