<div>
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <div class="w-full py-3 pl-6 pr-3 bg-gray-50 sm:flex sm:justify-between sm:items-center">
            <div class="flex items-center">
                <h3 class="font-semibold">
                    Kalender Treatment
                </h3>
            </div>
            <div class="flex items-center gap-4 mt-3 text-sm text-center sm:mt-0 sm:text-right">
                <input wire:model="selectedDay" type="date"
                    class="block w-full px-2 py-1 text-sm border border-gray-200 rounded focus:border-brand-100 focus:ring-0 focus:ring-brand-50" />
                <div class="inline-flex">
                    <button wire:click="prevDay" type="button"
                        class="inline-flex items-center justify-center px-2 py-1 -mr-px space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-l shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                        <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-left" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button wire:click="nextDay" type="button"
                        class="inline-flex items-center justify-center px-2 py-1 space-x-2 text-sm font-semibold leading-5 text-gray-800 bg-white border border-gray-300 rounded-r shadow-sm focus:outline-none active:z-1 focus:z-1 hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none">
                        <svg class="inline-block w-5 h-5 -mx-1 hi-solid hi-chevron-right" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div>
            <div
                class="
                overflow-scroll
                grid grid-cols-[70px,repeat({{ $titles->count() }},200px)]
                grid-rows-[auto,repeat(61,40px)]
                max-h-[520px]
            ">
                <!-- Calendar frame -->
                <div
                    class="sticky top-0 z-10 col-start-1 row-start-1 py-2 text-sm font-medium bg-white border-b border-slate-100 bg-clip-padding text-slate-900">
                </div>
                @foreach ($titles as $item)
                    <div
                        class="row-start-1 col-start-{{ $loop->iteration + 1 }} sticky top-0 z-10 bg-white border-slate-100 bg-clip-padding text-slate-900 border-b text-sm font-medium py-2 text-center">
                        {{ $item['name'] }}
                    </div>
                @endforeach

                @foreach ($times as $time)
                    <div
                        class="row-start-{{ $time['row-start'] }} col-start-1 border-slate-100 border-r text-xs p-1.5 pt-0 text-right text-slate-400 uppercase sticky z-10 left-0 bg-white font-medium">
                        {{ $time['time'] }}</div>

                    @for ($i = 2; $i <= $titles->count() + 1; $i++)
                        <div
                            class="row-start-{{ $time['row-start'] }} col-start-{{ $i }} border-slate-100 border-b border-r">
                        </div>
                    @endfor
                @endforeach

                @foreach ($schedules as $schedule)
                    <div wire:key="{{ $schedule['id'] }}"
                        class="text-slate-800 m-1 p-2 relative overflow-y-scroll {{ $schedule['classes'] }}">
                        <a href="{{ route('orders.show', $schedule['id']) }}" class="flex flex-col">
                            <span class="text-xs">{{ $schedule['time'] }}</span>
                            <span class="mt-4 text-xs">{{ $schedule['place'] }}</span>
                            <span class="text-xs ">{{ $schedule['address'] }}</span>
                            <span class="text-xs font-medium">{{ $schedule['client_name'] }}</span>
                            <span class="mt-2 text-xs">{{ $schedule['treatments'] }}</span>

                            <div class="absolute flex items-center top-1 right-2">
                                @if ($schedule['status'] === 'Selesai')
                                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M4.75 12C4.75 7.99594 7.99594 4.75 12 4.75V4.75C16.0041 4.75 19.25 7.99594 19.25 12V12C19.25 16.0041 16.0041 19.25 12 19.25V19.25C7.99594 19.25 4.75 16.0041 4.75 12V12Z">
                                        </path>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M9.75 12.75L10.1837 13.6744C10.5275 14.407 11.5536 14.4492 11.9564 13.7473L14.25 9.75">
                                        </path>
                                    </svg>
                                @elseif ($schedule['status'] === 'Pending')
                                    <svg class="text-red-600" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M4.75 12C4.75 7.99594 7.99594 4.75 12 4.75V4.75C16.0041 4.75 19.25 7.99594 19.25 12V12C19.25 16.0041 16.0041 19.25 12 19.25V19.25C7.99594 19.25 4.75 16.0041 4.75 12V12Z">
                                        </path>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" d="M9.75 9.75L14.25 14.25"></path>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" d="M14.25 9.75L9.75 14.25"></path>
                                    </svg>
                                @else
                                    <svg class="text-green-600" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="7.25" stroke="currentColor"
                                            stroke-width="1.5"></circle>
                                        <path stroke="currentColor" stroke-width="1.5" d="M12 8V12L14 14"></path>
                                    </svg>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
