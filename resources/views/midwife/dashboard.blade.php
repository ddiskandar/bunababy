<x-layouts.midwife>
    <div>
        <div class="bg-pink-100 p-6 flex flex-row items-center justify-between">
            <div>
                <img src="{{ asset('images/logo.svg') }}" />
            </div>
            <div>
                Keluar
            </div>
        </div>
        <div class="bg-pink-100 px-6 pb-16 flex flex-row justify-between">
            <div>
                Hai, Bidan {{ auth()->user()->name }}
            </div>
            <div>
                {{ today()->format('d m Y') }}
            </div>
        </div>

        <div class="mx-6 -mt-10 bg-pink-600 text-white rounded-lg py-6 flex flex-row justify-around shadow-lg">
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-3xl">
                    4
                </div>
                <div>
                    Jadwal Hari ini
                </div>
            </div>
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-3xl">
                    4
                </div>
                <div>
                    Selesai Hari ini
                </div>
            </div>
        </div>

        <div class="mx-6 py-6">
            <div class="text-pink-600 font-semibold text-lg">Jadwal</div>
            <ul class="gap-3 flex flex-col mt-2">
                @foreach ($schedules as $schedule)
                <li>
                    <a wire:navigate href="{{ route('midwife.order.show', $schedule->id) }}">
                        <div class="bg-pink-50 rounded-lg  p-6">
                            <div>{{ $schedule->status->getLabel() }}</div>
                            <div>{{ $schedule->getLongDateTime() }}</div>
                            <div>{{ $schedule->customer->name }}</div>
                            <div>{{ $schedule->place->name }}</div>
                            <div>{{ $schedule->address->full_address }}</div>
                            <div>{{ $schedule->listTreatments }}</div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-layouts.midwife>
