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
                    {{ $orders->count() }}
                </div>
                <div>
                    Jadwal Hari ini
                </div>
            </div>
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-3xl">
                    {{ $orders->whereIn('status', [\App\Enums\OrderStatus::FINISHED, \App\Enums\OrderStatus::COMPLETED])->count() }}
                </div>
                <div>
                    Selesai Hari ini
                </div>
            </div>
        </div>

        <div class="mx-6 py-6">
            <div class="text-pink-600 font-semibold text-lg">Jadwal</div>
            <ul class="gap-3 flex flex-col mt-2">
                @forelse ($orders as $order)
                <li>
                    <a wire:navigate href="{{ route('midwife.order.show', $order->id) }}">
                        <div @class([
                                'rounded-lg p-6 flex flex-col gap-3 shadow-md',
                                'bg-danger-100' => $order->status === \App\Enums\OrderStatus::CANCELLED || $order->status === \App\Enums\OrderStatus::PENDING,
                                'bg-success-100' => $order->status === \App\Enums\OrderStatus::BOOKED,
                                'bg-warning-100' => $order->status === \App\Enums\OrderStatus::ON_HOLD,
                                'bg-info-100' => $order->status === \App\Enums\OrderStatus::IN_SERVICE || $order->status === \App\Enums\OrderStatus::COMPLETED,
                                'bg-primary-100' => $order->status === \App\Enums\OrderStatus::FINISHED,
                            ])>
                            <div class="flex flex-row justify-between items-center">
                                <div>{{ $order->id }}</div>
                                <div>{{ $order->status->getLabel() }}</div>
                            </div>

                            <div>
                                <div>{{ $order->customer->name }}</div>
                                <div>{{ $order->getLongDateTime() }}</div>
                            </div>

                            @if ($order->place->type === \App\Enums\PlaceType::HOMECARE)
                            <div>
                                <div>{{ $order->place->name }}</div>
                                <div>{{ $order->address->full_address }}</div>
                            </div>
                            @endif

                            @if ($order->place->type === \App\Enums\PlaceType::CLINIC)
                                <div>{{ $order->place->name }}, {{ $order->room->name }}</div>
                            @endif

                            <div>{{ $order->listTreatments }}</div>
                        </div>
                    </a>
                </li>
                @empty
                <li>Tidak ada jadwal</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-layouts.midwife>
