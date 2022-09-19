<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between pt-6 pb-2">
        <div class="text-lg font-semibold">Schedules</div>
        <div class="flex items-center justify-between gap-4 text-sm">
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

    <ul>
        @forelse ($schedules as $schedule)
            <li class="w-full text-sm bg-white px-6 py-3 rounded ">
                <a href="{{ route('orders.show', $schedule->id) }}">
                    <div class="flex flex-col gap-1 md:flex-row md:justify-between md:items-center">
                        <div class="flex justify-between w-full items-start md:items-center">
                            <div class="space-y-2 md:flex md:justify-between md:items-center flex-1">
                                <div class="text-lg font-semibold">
                                    @foreach ($schedule->treatments as $treatment)
                                        <span>{{ $treatment->name }}</span>@if(!$loop->last)<span>, </span>@endif
                                    @endforeach
                                </div>
                                <div>
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <polyline points="12 7 12 12 15 15"></polyline>
                                        </svg>
                                        <div class="text-sm font-medium">
                                            <div>{{ $schedule->start_datetime->isoFormat('HH:mm') . ' - ' . $schedule->end_datetime->isoFormat('HH:mm') }} WIB</div>
                                        </div>
                                    </div>
                                    <div class="ml-6">
                                        {{ $schedule->place() }}
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        {{ $schedule->client->name }}
                                    </div>
                                    <div>
                                        {{ $schedule->address->kecamatan->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-1/3 flex justify-end">
                                <div @class([
                                'inline-flex px-6 py-1 leading-4 font-semibold text-white text-xs rounded-full',
                                'bg-orange-400' => $schedule->status == '1',
                                'bg-bunababy-100' => $schedule->status == '2',
                                'bg-blue-400' => $schedule->status == '3',
                            ])>
                                {{ $schedule->status() }}
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        @empty
            <li class="py-12 w-full border rounded flex flex-col items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 " width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M19.823 19.824a2 2 0 0 1 -1.823 1.176h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 1.175 -1.823m3.825 -.177h9a2 2 0 0 1 2 2v9"></path>
                    <line x1="16" y1="3" x2="16" y2="7"></line>
                    <line x1="8" y1="3" x2="8" y2="4"></line>
                    <path d="M4 11h7m4 0h5"></path>
                    <line x1="11" y1="15" x2="12" y2="15"></line>
                    <line x1="12" y1="15" x2="12" y2="18"></line>
                    <line x1="3" y1="3" x2="21" y2="21"></line>
                </svg>
                <p class="font-medium text-sm mt-4">
                    Tidak ada jadwal
                </p>
            </div>
        @endforelse
    </ul>
</div>
