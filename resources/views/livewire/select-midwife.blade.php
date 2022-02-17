<div
    x-data="{ expanded: false }""
    class="p-4 border border-pink-200 rounded"
>
    <div class="flex items-center justify-between ">
        <div>
            <img src="https://source.unsplash.com/mEZ3PoFGs_k/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
            <span class="ml-4 text-xl font-semibold">{{ $midwife->name }}</span>
        </div>
        <div
            x-on:click="expanded = ! expanded"
            class="flex items-center px-4 py-1 text-xs text-pink-600 border border-pink-600 rounded-full cursor-pointer">
            <span>Pilih Jadwal</span>
            <div class="ml-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>
    </div>

    <div
        {{-- :class="expanded ? '' : 'invisible'" --}}
        x-show="expanded"
        x-transition:enter="transition ease-in-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-y-0 -translate-y-1/2"
        x-transition:enter-end="opacity-100 transform scale-y-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-300"
        x-transition:leave-start="opacity-100 transform scale-y-100 translate-y-0"
        x-transition:leave-end="opacity-0 transform scale-y-0 -translate-y-1/2"
    >
        <div class="flex items-center justify-between py-6 mt-4 border-t border-pink-200">
            <div wire:click="prevMonth">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </div>
            <div class="font-semibold">
                {{ \Carbon\Carbon::parse($selectedMonth)->isoFormat('MMMM YYYY') }}
            </div>
            <div wire:click="nextMonth">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </div>

        <div class="grid grid-cols-7 gap-6">
            <div class="text-sm font-semibold text-center text-gray-500">Sen</div>
            <div class="text-sm font-semibold text-center text-gray-500">Sel</div>
            <div class="text-sm font-semibold text-center text-gray-500">Rab</div>
            <div class="text-sm font-semibold text-center text-gray-500">Kam</div>
            <div class="text-sm font-semibold text-center text-gray-500">Jum</div>
            <div class="text-sm font-semibold text-center text-gray-500">Sab</div>
            <div class="text-sm font-semibold text-center text-gray-500">Min</div>
            @foreach ($data as $day)
                @if (\Carbon\Carbon::parse($day['date'])->gte(today()))
                    <div
                        @if (\Carbon\Carbon::parse($day['date'])->isSameMonth(\Carbon\Carbon::parse($selectedMonth)))
                            class="flex flex-col items-center justify-center text-gray-700"
                        @else
                            class="flex flex-col items-center justify-center text-gray-300"
                        @endif
                    >
                        @if (\Carbon\Carbon::parse($day['date'])->gte(today()))

                            @if ($day['status'] == 'penuh')
                                <div class=" cursor-not-allowed ">
                                    {{ \Carbon\Carbon::parse($day['date'])->isoFormat('DD') }}
                                </div>
                                <div class="w-3 h-3 bg-red-400 border-2 border-white rounded-full"></div>

                            @elseif($day['status'] == 'tersedia')
                            <div
                                wire:click="selectDate({!! \Carbon\Carbon::parse($day['date'])->isoFormat('DD') !!}, {!! \Carbon\Carbon::parse($day['date'])->isoFormat('MM') !!}, {!! \Carbon\Carbon::parse($day['date'])->isoFormat('YYYY') !!})"
                                class="cursor-pointer">
                                {{ \Carbon\Carbon::parse($day['date'])->isoFormat('DD') }}
                            </div>
                            <div class="w-3 h-3 bg-blue-400 border-2 border-white rounded-full"></div>

                            @else
                                <div
                                    wire:click="selectDate({!! \Carbon\Carbon::parse($day['date'])->isoFormat('DD') !!}, {!! \Carbon\Carbon::parse($day['date'])->isoFormat('MM') !!}, {!! \Carbon\Carbon::parse($day['date'])->isoFormat('YYYY') !!})"
                                    class="cursor-pointer">
                                    {{ \Carbon\Carbon::parse($day['date'])->isoFormat('DD') }}
                                </div>
                                <div class="w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                            @endif

                        @endif

                    </div>
                @else
                <div class="flex flex-col items-center justify-center text-gray-300">
                    <div class=" cursor-not-allowed ">
                        {{ \Carbon\Carbon::parse($day['date'])->isoFormat('DD') }}
                    </div>

                </div>
                @endif

            @endforeach
        </div>

        <div class="flex items-center mt-8 space-x-4 sm:ml-6">
            <div class="flex items-center">
                <div class="w-3 h-3 bg-red-400 border-2 border-white rounded-full"></div>
                <span class="ml-2 text-xs">Penuh</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 bg-blue-400 border-2 border-white rounded-full"></div>
                <span class="ml-2 text-xs">Ada slot kosong</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                <span class="ml-2 text-xs">Tersedia</span>
            </div>
        </div>
    </div>


</div>
