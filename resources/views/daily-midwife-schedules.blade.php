<div>
    <div class="flex items-center justify-between pt-6 pb-2">
        <div class="text-lg font-semibold">Schedules</div>
        <div class="flex items-center gap-4 text-sm">
            <div>
                {{ $selectedDay->isoFormat('dddd, D MMMM YYYY') }}
            </div>
            <div class="inline-flex">
                <button wire:click="prevDay" type="button" class="inline-flex items-center justify-center px-2 py-1 -mr-px space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-l shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-left" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                </button>
                <button wire:click="nextDay" type="button" class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-r shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                    <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-right" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                </button>
            </div>
        </div>
    </div>

<!-- Card Body -->
<div class="overflow-hidden rounded shadow">
    <!-- Responsive Table Container -->
    <div class="min-w-full overflow-x-auto bg-white ">
        <!-- Alternate Responsive Table -->
        <table class="min-w-full text-sm align-middle">
        <thead>
            <tr class="bg-slate-50">
                <th class="p-3 pl-6 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                    Tempat
                </th>
                <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                    Waktu
                </th>
                <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400">
                    Status
                </th>
                <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                    Client
                </th>
                <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                    Alamat
                </th>
                <th class="p-3 text-xs font-medium tracking-wider text-left uppercase text-slate-400 ">
                    Treatment
                </th>
                <th class="p-3 text-xs font-medium tracking-wider text-center uppercase sr-only text-slate-400">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($schedules as $schedule)
                <tr class="text-slate-800">
                    <td class="px-3 py-6 pl-6 whitespace-nowrap">
                        {{ $schedule->place() }}
                    </td>
                    <td class="px-3 py-6 whitespace-nowrap">
                        {{ $schedule->getTime() }}
                    </td>
                    <td class="px-3 py-6 whitespace-nowrap">
                        <span
                            @class([
                                'inline-flex items-center pl-2 pr-4 text-xs font-semibold leading-5  rounded-full',
                                'text-green-800 bg-green-100' => $schedule->status() == 'Aktif',
                                'text-blue-800 bg-blue-100' => $schedule->status() == 'Selesai',
                                'text-yellow-800 bg-yellow-100' => $schedule->status() == 'Pending',
                            ])>
                            <span
                                @class([
                                    'w-2 h-2 mr-2 rounded-full',
                                    'bg-green-600 ' => $schedule->status() == 'Aktif',
                                    'bg-blue-600 ' => $schedule->status() == 'Selesai',
                                    'bg-yellow-600 ' => $schedule->status() == 'Pending',
                                ])></span>
                            <span>{{ $schedule->status() }}</span>
                        </span>
                    </td>
                    <td class="px-3 py-6 whitespace-nowrap">
                        {{ $schedule->client->name }}
                    </td>
                    <td class="px-3 py-6 whitespace-nowrap">
                        {{ $schedule->address->kecamatan->name }}
                    </td>
                    <td class="px-3 py-6 whitespace-nowrap">
                        {{ $schedule->treatments->implode('name', ', ') }}
                    </td>
                    <td class="py-6 pl-3 pr-6 text-center whitespace-nowrap">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('orders.show',$schedule->id) }}"  class="text-slate-400 hover:text-bunababy-200">
                                Lihat
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-24 text-center">Tidak ada jadwal</td>
                </tr>
            @endforelse
        </tbody>
        </table>
        <!-- END Alternate Responsive Table -->
    </div>
    <!-- END Responsive Table Container -->
</div>
<!-- END Card Body -->
</div>
