<x-layouts.midwife>
    <div>
        <div class="bg-pink-100 p-6 flex flex-row items-center justify-between">
            <div>
                <img src="{{ asset('images/logo.svg') }}" />
            </div>
            <div>
                <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                  </form>
            </div>
        </div>
        <div class="bg-pink-100 px-6 pb-16 flex flex-row justify-between">
            <div>
                Hai, {{ auth()->user()->name }}
            </div>
            <div>
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
