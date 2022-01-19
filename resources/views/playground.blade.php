<x-guest-layout>

<div class="p-4">

<div class="mb-4 text-2xl font-semibold">
    {{ \Carbon\Carbon::parse($selectedMonth)->isoFormat('MMMM YYYY') }}
</div>

<div class="grid grid-cols-7 gap-6">
    <div class="text-sm font-semibold text-gray-500">Senin</div>
    <div class="text-sm font-semibold text-gray-500">Selasa</div>
    <div class="text-sm font-semibold text-gray-500">Rabu</div>
    <div class="text-sm font-semibold text-gray-500">Kamis</div>
    <div class="text-sm font-semibold text-gray-500">Jum'at</div>
    <div class="text-sm font-semibold text-gray-500">Sabtu</div>
    <div class="text-sm font-semibold text-gray-500">Minggu</div>
    @foreach ($data as $day)
        @if ($day['date']->greaterThan(now()))
            <div
                @if ($day['date']->isSameMonth(\Carbon\Carbon::parse($selectedMonth)))
                    class="flex flex-col items-center justify-center text-gray-700"
                @else
                    class="flex flex-col items-center justify-center text-gray-300"
                @endif
            >
                <div class="text-lg font-semibold">
                    {{ $day['date']->isoFormat('DD') }}
                </div>

                @if ($day['date']->greaterThan(now()))
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
                {{ $day['date']->isoFormat('DD') }}
            </div>

        </div>
        @endif

    @endforeach
</div>
</div>

</x-guest-layout>
