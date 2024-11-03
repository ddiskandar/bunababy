<x-layouts.midwife>
    <div>
        <div
        @class([
            'text-white pb-6',
            'bg-danger-600' => $order->status === \App\Enums\OrderStatus::CANCELLED || $order->status === \App\Enums\OrderStatus::PENDING,
            'bg-success-600' => $order->status === \App\Enums\OrderStatus::BOOKED,
            'bg-warning-600' => $order->status === \App\Enums\OrderStatus::ON_HOLD,
            'bg-info-600' => $order->status === \App\Enums\OrderStatus::IN_SERVICE || $order->status === \App\Enums\OrderStatus::COMPLETED,
            'bg-primary-600' => $order->status === \App\Enums\OrderStatus::FINISHED,
        ])>
            <div class="flex p-6 flex-row justify-between items-center">
                <div class="flex flex-row gap-4 items-center">
                    <a href="/" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <div class="font-semibold text-2xl">{{ $order->id }}</div>
                </div>
                <div>{{ $order->status->getLabel() }}</div>
            </div>
        </div>

        <div class="flex flex-col gap-6">
            <div class="px-6 pt-6 bg-white rounded-t-3xl -mt-6">
                <div class="text-sm font-medium leading-6 text-gray-950 dark:text-white">{{ $order->customer->name }}</div>
                <div>{{ $order->getLongDate() }}</div>
                <div>{{ $order->getLongTime() }}</div>
            </div>

            <div class="px-6">
                <div class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Tempat</div>
                <div class="mt-2 fi-in-repeatable-item block rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-white/5 dark:ring-white/10">
                    @if ($order->place->type === \App\Enums\PlaceType::HOMECARE)
                        <div>{{ $order->place->name }}</div>
                        <div>{{ $order->address->full_address }}</div>
                    @endif

                    @if ($order->place->type === \App\Enums\PlaceType::CLINIC)
                        <div>{{ $order->place->name }}, {{ $order->room->name }}</div>
                    @endif
                </div>
            </div>

            <div class="px-6">
                <div class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Daftar Treatment</div>
                <ul class="mt-2">
                    @foreach ($order->treatments as $treatment)
                        <li class="fi-in-repeatable-item block rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-white/5 dark:ring-white/10">
                            <div class="flex flex-col gap-y-3">
                                <div class="gap-y-2 flex flex-col">
                                    <div class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Nama Treatment</div>
                                    <div>{{ $treatment['treatment_name'] }}</div>
                                </div>
                                <div class="gap-y-2 flex flex-col">
                                    <div class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Pasien</div>
                                    <div>{{ $treatment['family_name'] }}</div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="px-6">
                @livewire('midwife.screening-order-component', ['order' => $order])
            </div>

            <div class="px-6">
                @livewire('midwife.finish-order-component', ['order' => $order])
            </div>
        </div>
    </div>
</x-layouts.midwife>
