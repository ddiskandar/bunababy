<x-layouts.midwife>
    <div>
        <div class="bg-pink-100 p-6 flex flex-row items-center justify-between">
            <div>
                <img src="{{ asset('images/logo.svg') }}" />
            </div>
            <div>
                <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                    @csrf
                    <div class="flex flex-row gap-2 items-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        <button type="submit">Keluar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-pink-100 text-slate-700 px-6 pb-16 flex flex-row justify-between">
            <div class="text-xl font-semibold">
               {{ auth()->user()->name }}
            </div>
            <div class="text-xl font-semibold">
                {{ today()->format('d m Y') }}
            </div>
        </div>

        <div class="mx-6 -mt-10 bg-pink-600 text-white rounded-lg py-6 flex flex-row justify-around shadow-lg">
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-3xl">
                    {{ $count }}
                </div>
                <div>
                    Jadwal Bulan ini
                </div>
            </div>
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-3xl">
                    {{ $overtime }}
                </div>
                <div>
                    Lembur Bulan ini
                </div>
            </div>
        </div>

        <div class="mx-6 py-6">
            <div class="text-pink-600 font-semibold text-lg">Penjadwalan</div>
            <ol class="mt-4 gap-3 flex flex-col">
                @forelse ($timetables as $timetable)
                    <li @class([
                        'p-6 rounded shadow-lg',
                        'bg-warning-200 ' => $timetable->type === \App\Enums\TimetableType::LEAVE,
                        'bg-success-200 ' => $timetable->type === \App\Enums\TimetableType::OVERTIME,
                        'bg-primary-200 ' => $timetable->type === \App\Enums\TimetableType::CLINIC,
                    ])>
                        <div class="flex flex-row justify-between">
                            <div class="font-semibold">{{ $timetable->type->getLabel() }}</div>
                            <div>{{ $timetable->date->format('d/m/Y') }}</div>
                        </div>
                        <div>{{ $timetable->note }}</div>
                    </li>
                @empty
                    <li>Belum ada Penjadwalan</li>
                @endforelse
            </ol>
        </div>
    </div>
</x-layouts.midwife>
