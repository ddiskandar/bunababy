<div>
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Wilayah
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">

                <div class="flex items-center space-x-2 space-x-reverse sm:space-x-2">
                    <a href="{{ route('kabupaten') }}" class="order-2 text-xs font-medium uppercase sm:order-1 text-slate-400 hover:text-bunababy-200 ">
                        Atur Kabupaten
                    </a>
                    <div class="order-1 w-40 sm:order-2">
                        <select wire:model="filterKabupaten" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Kabupaten</option>
                            @foreach ($kabupatens as $kabupaten)
                                <option value="{{ $kabupaten->id }}">{{ $kabupaten->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

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
                    <button wire:click="showCreateNewKecamatanDialog" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 focus:ring-0 active:bg-white active:border-bunababy-100">
                        + Tambah Baru
                    </button>

                </div>

            </div>
        </div>
        <div class="w-full p-3 border-b border-gray-100 grow">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="search" placeholder="Mencari berdasarkan nama atau jarak ..." />
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
                            <th class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase whitespace-nowrap text-slate-400">
                                Nama
                            </th>
                            <th class="p-3 text-xs font-medium tracking-wider text-center uppercase whitespace-nowrap text-slate-400">
                                Jarak (Km)
                            </th>
                            <th class="p-3 text-xs font-medium tracking-wider text-center uppercase whitespace-nowrap text-slate-400">
                                Jumlah Bidan
                            </th>
                            <th class="p-3 text-xs font-medium tracking-wider text-left uppercase whitespace-nowrap text-slate-400">
                                Kota / Kabupaten
                            </th>
                            <th class="p-3 text-xs font-medium tracking-wider text-center uppercase whitespace-nowrap text-slate-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($kecamatan as $item)
                            <tr @class([
                                '',
                                'bg-slate-50/30' => $loop->even,
                                'text-slate-400' => ! $item->active,
                            ])>
                                <td class="p-3 pl-6 align-top whitespace-nowrap">
                                    <p class="font-semibold">{{ $item->name }}</p>
                                </td>
                                <td class="w-64 p-3 text-center align-top">
                                    {{ $item->distance }}
                                </td>
                                <td class="w-64 p-3 text-center align-top">
                                    {{ $item->midwives_count }}
                                </td>
                                <td class="p-3 align-top">
                                    <p>{{ $item->kabupaten->name }}</p>
                                </td>
                                <td class="p-3 text-center align-top">
                                    <div class="flex justify-center space-x-2">
                                        <button wire:click="ShowEditKecamatanDialog({{ $item->id }})" class="text-slate-400 hover:text-bunababy-200">
                                            <x-icon-pencil/>
                                        </button>
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
            {{ $kecamatan->links() }}
        </div>

        <!-- END Card Footer: Pagination -->

    </div>
    <!-- END Card -->

    <x-dialog wire:model="showDialog">
        <form wire:submit.prevent="save">
            <x-title>Data Kecamatan</x-title>

            <div class="mt-2 space-y-3 overflow-y-auto h-72">
                <div class="space-y-1">
                    <x-label for="state.name">Nama</x-label>
                    <x-input wire:model.lazy="state.name" class="w-full" type="text" id="state.name" />
                    <x-input-error for="state.name" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label for="state.distance">Jarak (Km)</x-label>
                    <x-input wire:model.lazy="state.distance" class="w-full" type="number" id="state.distance" />
                    <x-input-error for="state.distance" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label for="state.kabupaten_id">Kabupaten</x-label>
                    <select wire:model.lazy="state.kabupaten_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.kabupaten_id">
                        <option value="" selected>-- Pilih salah satu</option>
                        @foreach ($kabupatens as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="state.kabupaten_id" class="mt-2" />
                </div>
                <div class="py-4 space-y-1">
                    <div class="inline-flex items-center ml-2">
                        <div class="flex items-center h-5 ">
                            <input type="checkbox" wire:model.lazy="state.active" name="state.active" class="w-12 transition-all duration-150 ease-out rounded-full cursor-pointer form-switch h-7 text-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50">
                        </div>
                        <div class="ml-2 ">
                            <x-label for="state.active">Aktif</x-label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="py-4">
                <button
                    wire:loading.attr="disabled"
                    type="submit"
                    class="flex items-center justify-center w-full h-12 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                >
                    <span wire:loading wire:target="save">
                        <x-loading-spinner />
                    </span>
                    <span wire:loading.remove wire:target="save" class="font-semibold">
                        {{ __('Simpan') }}
                    </span>
                </button>
            </div>
        </form>
    </x-dialog>
</div>
