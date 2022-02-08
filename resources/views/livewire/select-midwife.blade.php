<div class="p-4">
    <div>
        {{ $midwife->name }}
    </div>

    <div class="flex items-center justify-between py-4">
        <div wire:click="prevMonth">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </div>
        <div class="text-2xl font-semibold">
            {{ \Carbon\Carbon::parse($selectedMonth)->isoFormat('MMMM YYYY') }}
        </div>
        <div wire:click="nextMonth">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
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
                    <div class="text-lg font-semibold">
                        {{ \Carbon\Carbon::parse($day['date'])->isoFormat('DD') }}
                    </div>

                    @if (\Carbon\Carbon::parse($day['date'])->gte(today()))
                        <div
                            @if ($day['status'] == 'penuh')
                                class="w-3 h-3 bg-red-400 border-2 border-white rounded-full"
                            @elseif($day['status'] == 'tersedia')
                                class="w-3 h-3 bg-blue-400 border-2 border-white rounded-full"
                            @else
                                class="w-3 h-3 bg-green-400 border-2 border-white rounded-full"
                            @endif
                        >
                        </div>
                    @endif

                </div>
            @else
            <div class="flex flex-col items-center justify-center text-gray-300">
                <div class="text-lg font-semibold">
                    {{ \Carbon\Carbon::parse($day['date'])->isoFormat('DD') }}
                </div>

            </div>
            @endif

        @endforeach
    </div>


</div>
