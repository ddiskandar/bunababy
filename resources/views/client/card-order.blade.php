<div class="w-full p-6 bg-white border rounded shadow-lg border-brand-50 shadow-brand-50">
    <div class="flex flex-col gap-3 mb-4 lg:flex-row lg:justify-between">
        <div class="flex items-center gap-2">
            <svg class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 8.75C4.75 7.64543 5.64543 6.75 6.75 6.75H17.25C18.3546 6.75 19.25 7.64543 19.25 8.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V8.75Z"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4.75V8.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 4.75V8.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 10.75H16.25"></path>
            </svg>

            <div class="text-sm font-medium">
                <div>{{ $reservation->start_datetime->isoFormat('dddd, DD MMMM Y') }}</div>
                <div>{{ $reservation->start_datetime->isoFormat('HH:mm') . ' - ' . $reservation->end_datetime->isoFormat('HH:mm') }} WIB</div>
            </div>
        </div>
        <div>
            <div @class([
                'inline-flex px-6 py-1 leading-4 font-semibold text-white text-xs rounded-full',
                'bg-orange-400' => $reservation->status === \App\Models\Order::STATUS_UNPAID,
                'bg-brand-100' => $reservation->status === \App\Models\Order::STATUS_LOCKED,
                'bg-blue-400' => $reservation->status === \App\Models\Order::STATUS_FINISHED,
            ])>{{ $reservation->getStatusString() }}</div>
        </div>
    </div>
    <div class="py-2">
        <div class="text-lg font-semibold">
            @foreach ($reservation->treatments as $treatment)
                <span>{{ $treatment->name }}</span>@if(!$loop->last)<span>, </span>@endif
            @endforeach
        </div>
        <div>
            <span>{{ $reservation->place->name }}</span>
            <span>{{ $reservation->midwife->name ?? '' }}</span>
        </div>
    </div>
    <div class="grid grid-cols-2 mt-4">
        <div>
            <div class="text-sm">Total Pembayaran</div>
            <div class="font-bold">{{ rupiah($reservation->getGrandTotal()) }}</div>
        </div>
        <div>
            <div class="text-sm">Sisa Pembayaran</div>
            @if ($reservation->getRemainingPayment() > 0)
                <div class="font-bold text-red-600">{{ rupiah($reservation->getRemainingPayment()) }}</div>
            @else
                <div class="flex items-center">
                    <span class="text-sm font-semibold text-green-800">
                        Lunas
                    </span>
                    <svg class="w-4 h-4 ml-1 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            @endif
        </div>
    </div>
    <div class="mt-6">
        <a href="{{ $route }}" class="inline-block w-full py-2 font-semibold text-center text-white transition-all rounded-full hover:bg-brand-100 bg-brand-200">
            {{ $label }}
        </a>
    </div>
</div>
