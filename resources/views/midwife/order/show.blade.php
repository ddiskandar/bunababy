<x-layouts.midwife>
    <div class="bg-pink-50">
        <div class="p-6 flex flex-row gap-4 items-center">
            <a href="/" wire:navigate>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div class="font-semibold text-2xl">{{ $order->id }}</div>
        </div>
    </div>
    <div class="p-6">
        <div>{{ $order->customer->name }}</div>
        <div>{{ $order->place->name }}</div>
        {{ $order->getLongDateTime() }}
        {{ $order->midwife->name ?? '' }}
        <div>{{ $order->address->full_address }}</div>
    </div>

    <div class="p-6">
        <div>Treatment</div>
        <ul>
            @foreach ($order->treatments as $treatment)
                <li>{{ $treatment['treatment_name'] }} {{ $treatment['family_name'] }}</li>
            @endforeach
        </ul>
    </div>
</x-layouts.midwife>
