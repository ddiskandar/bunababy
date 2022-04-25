<div class="p-4 border rounded border-bunababy-50"
    x-data="{ expanded: false }"
>
    <div class="flex items-center justify-between ">
        <div>
            <img src="{{ $midwife->profile_photo_url }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
            <span class="ml-2 text-xl font-semibold">{{ $midwife->name }}</span>
        </div>
        <button class="flex items-center px-4 py-1 text-xs border rounded-full cursor-pointer text-bunababy-100 border-bunababy-100"
            x-on:click="expanded = ! expanded"
        >
            <span class="font-semibold"><span class="hidden md:inline-block">Pilih </span> Jadwal</span>
            <div class="ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" :class=" expanded == true ? 'rotate-180' : ''" class="w-5 h-5 transition-all duration-700" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </div>

    <div x-cloak x-show="expanded"
        x-transition:enter="transition ease-in-out duration-500"
        x-transition:enter-start="opacity-0 transform scale-y-0 -translate-y-1/2"
        x-transition:enter-end="opacity-100 transform scale-y-100 translate-y-0"
        x-transition:leave="transition ease-in-out duration-300"
        x-transition:leave-start="opacity-100 transform scale-y-100 translate-y-0"
        x-transition:leave-end="opacity-0 transform scale-y-0 -translate-y-1/2"
    >
        <div class="flex items-center justify-between py-8 mt-4 border-t border-bunababy-50">
            <div wire:click="prevMonth" class="cursor-pointer ">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </div>
            <div class="font-semibold">
                {{ \Carbon\Carbon::parse($selectedMonth)->isoFormat('MMMM YYYY') }}
            </div>
            <div wire:click="nextMonth" class="cursor-pointer ">
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
                    <div wire:click="selectDate({!! \Carbon\Carbon::parse($day['date'])->isoFormat('DD') !!}, {!! \Carbon\Carbon::parse($day['date'])->isoFormat('MM') !!}, {!! \Carbon\Carbon::parse($day['date'])->isoFormat('YYYY') !!})"
                        @if (\Carbon\Carbon::parse($day['date'])->isSameMonth(\Carbon\Carbon::parse($selectedMonth)))
                            class="flex flex-col items-center justify-center text-gray-700"
                        @else
                            class="flex flex-col items-center justify-center text-gray-300"
                        @endif
                    >

                    @if ($day['status'] == 'penuh')
                        <div class="flex flex-col items-center p-4 cursor-not-allowed">
                            <span>{{ \Carbon\Carbon::parse($day['date'])->isoFormat('DD') }}</span>
                            <div class="w-3 h-3 bg-red-400 border-2 border-white rounded-full"></div>
                        </div>

                    @elseif($day['status'] == 'tersedia')
                        <div class="flex flex-col items-center p-4 rounded cursor-pointer hover:bg-bunababy-50">
                            <span>{{ \Carbon\Carbon::parse($day['date'])->isoFormat('DD') }}</span>
                            <div class="w-3 h-3 bg-blue-400 border-2 border-white rounded-full"></div>
                        </div>

                    @else
                        <div class="flex flex-col items-center p-4 rounded cursor-pointer hover:bg-bunababy-50">
                            <span>{{ \Carbon\Carbon::parse($day['date'])->isoFormat('DD') }}</span>
                            <div class="w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                        </div>
                    @endif

                    </div>
                @else
                <div class="flex flex-col items-center justify-center text-gray-300 cursor-not-allowed"
                    wire:click="selectDate({!! \Carbon\Carbon::parse($day['date'])->isoFormat('DD') !!}, {!! \Carbon\Carbon::parse($day['date'])->isoFormat('MM') !!}, {!! \Carbon\Carbon::parse($day['date'])->isoFormat('YYYY') !!})"
                >
                    <div class="p-4">
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
