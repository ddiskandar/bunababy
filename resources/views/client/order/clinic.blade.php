<div>
    <div class="mb-4 font-semibold lg:text-lg">Pilih Jadwal Tersedia di Klinik</div>

    <div class="p-4 border rounded border-bunababy-50" >

        <div>
            <div class="flex items-center justify-between py-2 mb-4">
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
</div>
