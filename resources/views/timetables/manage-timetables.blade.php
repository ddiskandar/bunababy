<div>
    <!-- Card -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <!-- Card Header -->
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Penjadwalan
                </h3>
            </div>
            <div class="flex flex-col gap-2 mt-4 sm:mt-0 sm:flex-row sm:items-center sm:justify-end">

                <div class="flex items-center space-x-2 space-x-reverse sm:space-x-2">

                </div>

                <div class="flex space-x-2">
                    @if (auth()->user()->isAdmin())
                    <div class="w-36">
                        <select wire:model="filterMidwife" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Bidan</option>
                            @foreach ($midwives as $midwife)
                            <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class=" w-36">
                        <select wire:model="filterType" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="" selected="selected">Semua Type</option>
                            <option value="1">Klinik</option>
                            <option value="2">Lembur</option>
                            <option value="3">Libur</option>
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
                @if (auth()->user()->isAdmin())
                <div>
                    <button wire:click="showAddNewTimetableDialog" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded focus:outline-none hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 focus:ring-0 active:bg-white active:border-bunababy-100">
                        + Tambah Baru
                    </button>
                </div>
                @endif
            </div>
        </div>
        <div class="w-full p-3 border-b border-gray-100 grow">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center justify-center w-10 my-px ml-px text-gray-500 rounded-l pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="inline-block w-5 h-5 hi-solid hi-search"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="text" placeholder="Mencari berdasarkan nama, deskripsi, harga, atau durasi ..." />
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
                            Tanggal
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Type
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Catatan
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-center uppercase text-slate-400">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($timetables as $timetable)
                        <tr @class([
                            'text-slate-800',
                            'bg-slate-50/30' => $loop->even,
                            'text-slate-400' => ! $timetable->active,
                        ])>
                            <td class="p-3 pl-6 whitespace-nowrap">
                                <p class="font-semibold">{{ $timetable->midwife->name }}</p>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                {{ $timetable->date }}
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <p>{{ $timetable->type() }}</p>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <p>{{ $timetable->note }}</p>
                            </td>
                            <td class="p-3 text-center whitespace-nowrap">
                                <div class="flex justify-center space-x-2">
                                    <button wire:click="ShowEditTimetableDialog({{ $timetable->id }})" class="text-slate-400 hover:text-bunababy-200">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
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
            {{ $timetables->links() }}
        </div>

        <!-- END Card Footer: Pagination -->

    </div>
    <!-- END Card -->

    <x-notification wire:model="successMessage">
        Data berhasil disimpan
    </x-notification>

    <x-dialog wire:model="showDialog">

        <x-title>Data Penjadwalan</x-title>

        <div class="h-64 mt-2 space-y-3 overflow-y-auto">
            <div class="space-y-1">
                <x-label class="" for="state.midwife_user_id">Bidan</x-label>
                <select wire:model.lazy="state.midwife_user_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.midwife_user_id">
                    <option value="" selected>-- Pilih salah satu</option>
                    @foreach ($midwives as $midwife)
                        <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="state.midwife_user_id" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.date">Tanggal</x-label>
                <x-input wire:model.lazy="state.date" class="w-full" type="date" id="state.date" />
                <x-input-error for="state.date" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.type">Tipe</x-label>
                <select wire:model.lazy="state.type" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.type">
                    <option value="" selected>-- Pilih salah satu</option>
                    <option value="1">Lembur</option>
                    <option value="2">Libur / Cuti</option>
                </select>
                <x-input-error for="state.type" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="state.note">Catatan</x-label>
                <x-textarea wire:model.lazy="state.note" class="w-full" type="text" id="state.note" />
                <x-input-error for="state.note" class="mt-2" />
            </div>

        </div>

        <div class="py-4">
            <button
                wire:click="save"
                type="button"
                class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
            >Simpan</button>
        </div>

    </x-dialog>

</div>
