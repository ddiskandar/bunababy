<x-guest-layout>

<div class="grid grid-cols-7 gap-6 p-12">
    @foreach ($data as $day)
        @if ($day['date']->gt(now()))
            <div
                @if ($day['date']->isSameMonth(now()))
                    class="flex flex-col items-center justify-center text-gray-700"
                @else
                    class="flex flex-col items-center justify-center text-gray-300"
                @endif
            >
                <div class="text-lg font-semibold">
                    {{ $day['date']->isoFormat('DD') }}
                </div>

                @if ($day['date']->gt(now()))
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

</x-guest-layout>
