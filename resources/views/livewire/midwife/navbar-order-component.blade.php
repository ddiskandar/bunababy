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
