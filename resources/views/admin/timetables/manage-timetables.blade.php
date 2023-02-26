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

                {{-- <div class="flex items-center gap-4 text-sm">
                    <div>
                        {{ $selectedMonth->isoFormat('MMMM YYYY') }}
                    </div>
                    <div class="inline-flex">
                        <button wire:click="prevMonth" type="button" class="inline-flex items-center justify-center px-2 py-1 -mr-px space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-l shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                            <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-left" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        </button>
                        <button wire:click="nextMonth" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-r shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                            <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-right" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                        </button>
                    </div>
                </div> --}}

                <div class="flex items-center gap-4 mt-3 text-sm text-center sm:mt-0 sm:text-right">
                    <input wire:model="selectedMonth" type="month" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50"  />
                    <div class="inline-flex">
                        <button wire:click="prevMonth" type="button" class="inline-flex items-center justify-center px-2 py-1 -mr-px space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-l shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                            <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-left" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        </button>
                        <button wire:click="nextMonth" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-r shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                            <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-right" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                        </button>
                    </div>
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
                            <option value="1">Libur</option>
                            <option value="2">Lembur</option>
                            <option value="3">Klinik</option>
                        </select>
                    </div>

                    <div class="w-16 ">
                        <select wire:model="perPage" class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 ">
                            <option value="3">3</option>
                            <option value="8" selected="selected">8</option>
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
                <input wire:model="filterSearch" class="block w-full py-1 pl-10 pr-3 text-sm leading-6 border border-gray-200 rounded focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-50" type="search" placeholder="Mencari berdasarkan catatan ..." />
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
                        @if (auth()->user()->isAdmin())
                        <th class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Nama
                        </th>
                        @endif
                        <th class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Tanggal
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                            Tipe
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                            Catatan
                        </th>
                        <th class="p-3 text-xs font-medium tracking-wider text-center uppercase sr-only text-slate-400">
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
                            @if (auth()->user()->isAdmin())
                            <td class="p-3 pl-6 whitespace-nowrap">
                                <p class="font-semibold">{{ $timetable->midwife->name }}</p>
                            </td>
                            @endif
                            <td class="p-3 pl-6 whitespace-nowrap">
                                {{ $timetable->date->isoFormat('dddd, DD MMMM YYYY') }}
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <span
                                    @class([
                                        'inline-flex items-center pl-2 pr-4 text-xs font-semibold leading-5  rounded-full',
                                        'text-green-800 bg-green-100' => $timetable->type() == 'Lembur',
                                        'text-red-800 bg-red-100' => $timetable->type() == 'Libur',
                                        'text-yellow-800 bg-yellow-100' => $timetable->type() == 'Klinik',
                                    ])>
                                    <span
                                        @class([
                                            'w-2 h-2 mr-2 rounded-full',
                                            'bg-green-600 ' => $timetable->type() == 'Lembur',
                                            'bg-red-600 ' => $timetable->type() == 'Libur',
                                            'bg-yellow-600 ' => $timetable->type() == 'Klinik',
                                        ])></span>
                                    <span>{{ $timetable->type() }}</span>
                                </span>
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <p>{{ $timetable->note }}</p>
                            </td>
                            <td class="p-3 text-center whitespace-nowrap">
                                @if (auth()->user()->isAdmin())
                                <div class="flex items-center justify-center space-x-2">
                                    <button wire:click="ShowEditTimetableDialog({{ $timetable->id }})" class="text-slate-400 hover:text-bunababy-200">
                                        <x-icon-pencil />
                                    </button>
                                    <button wire:click="delete('{{ $timetable->id }}')" onclick="confirm('Yakin mau dihapus?') || event.stopImmediatePropagation()" class="text-slate-400 hover:text-bunababy-200">
                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 7.75L7.59115 17.4233C7.68102 18.4568 8.54622 19.25 9.58363 19.25H14.4164C15.4538 19.25 16.319 18.4568 16.4088 17.4233L17.25 7.75"></path>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 7.5V6.75C9.75 5.64543 10.6454 4.75 11.75 4.75H12.25C13.3546 4.75 14.25 5.64543 14.25 6.75V7.5"></path>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 7.75H19"></path>
                                        </svg>
                                    </button>
                                </div>
                                @endif
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

    <x-dialog wire:model="showDialog">
        <form wire:submit.prevent="save">
            <x-title>Data Penjadwalan</x-title>

            <div class="h-64 mt-2 space-y-3 overflow-y-auto">
                <div class="space-y-1">
                    <x-label   for="state.midwife_user_id">Bidan</x-label>
                    <select wire:model.lazy="state.midwife_user_id" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.midwife_user_id">
                        <option value="" selected>-- Pilih salah satu</option>
                        @foreach ($midwives as $midwife)
                            <option value="{{ $midwife->id }}">{{ $midwife->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="state.midwife_user_id" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label   for="state.date">Tanggal</x-label>
                    <x-input wire:model.lazy="state.date" class="w-full" type="date" id="state.date" />
                    <x-input-error for="state.date" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label   for="state.type">Tipe</x-label>
                    <select wire:model.lazy="state.type" class="w-full rounded-md border-bunababy-50 focus:border-bunababy-100 focus:ring-0 focus:ring-bunababy-100 focus:ring-opacity-50 disabled:bg-slate-100 disabled:opacity-75" type="text" id="state.type">
                        <option value="" selected>-- Pilih salah satu</option>
                        <option value="1">Libur</option>
                        <option value="2">Lembur</option>
                        <option value="3">Klinik</option>
                    </select>
                    <x-input-error for="state.type" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <x-label   for="state.note">Catatan</x-label>
                    <x-textarea wire:model.lazy="state.note" class="w-full" type="text" id="state.note" />
                    <x-input-error for="state.note" class="mt-2" />
                </div>

            </div>

            <div class="py-4">
                <button
                    wire:loading.attr="disabled"
                    type="submit"
                    class="flex items-center justify-center w-full h-12 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50 disabled:opacity-25"
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
