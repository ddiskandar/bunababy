<div>
    <div class="md:flex">
        <div class="flex-1">
            <x-title>Tanggal dan Waktu</x-title>
            <div>
                <div class="font-semibold">{{ $order->startDateTime->isoFormat('dddd, D MMMM G') }}</div>
                <span>{{ $order->startDateTime->isoFormat('HH:mm') . ' - ' . $order->endDateTime->isoFormat('HH:mm') }}
                    WIB</span>
            </div>
        </div>
        @if ($order->place->type === \App\Models\Place::TYPE_HOMECARE)
            <div class="flex-1 mt-6 md:mt-0">
                <x-title>Bidan </x-title>
                <div class="flex items-center">
                    <img src="{{ $order->midwife->profile_photo_url }}" alt="User Avatar"
                        class="inline-block w-10 h-10 rounded-full" />
                    <div class="ml-2 font-semibold">{{ $order->midwife->name }}</div>
                </div>
            </div>
        @endif
    </div>

    <div class="py-4">
        <x-title>Tempat</x-title>
        @if ($order->place->type === \App\Models\Place::TYPE_HOMECARE)
            <div class="font-semibold">{{ $order->place->name }}</div>
            <div class="text-sm">{{ $order->address->full_address ?? '-' }}</div>
        @else
            <div class="font-semibold">{{ $order->place->name . ', ' . $order->room->name }}</div>
            <div class="text-sm">{{ $order->place->desc }}</div>
        @endif
    </div>

    <div class="py-4">
        <x-title>Treatment dan Rincian Pembayaran</x-title>
        <ul class="divide-y divide-brand-50">
            @foreach ($order->treatments as $treatment)
                <li class="flex items-center justify-between py-2 text-sm">
                    <div>
                        <div class="font-medium">{{ $treatment->name }}</div>
                        <div class="truncate text-slate-600 ">
                            {{ $treatment->pivot->family_name . ', ' . ($treatment->pivot->family_age ?? '-') }}
                        </div>
                    </div>
                    <div>
                        <div>{{ rupiah($treatment->pivot->treatment_price) }}</div>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="pt-2 mt-2 text-sm border-t border-brand-50">
            <div class="flex justify-between py-2">
                <div>Subtotal</div>
                <div>{{ rupiah($order->total_price) }}</div>
            </div>

            @if ($order->place->type === \App\Models\Place::TYPE_HOMECARE)
                <div class="flex justify-between py-2">
                    <div>Transport</div>
                    <div>{{ rupiah($order->total_transport) }}</div>
                </div>
            @endif

            @if ($order->adjustment_amount !== 0)
                <div class="flex justify-between py-2">
                    <div>{{ $order->adjustment_name }}</div>
                    <div>{{ rupiah($order->adjustment_amount) }}</div>
                </div>
            @endif

            <div class="flex justify-between py-2 font-semibold">
                <div>Total Tagihan</div>
                <div>{{ rupiah($order->getGrandTotal()) }}</div>
            </div>

            <div class="flex justify-between py-2">
                <div>Sudah Bayar</div>
                <div>{{ rupiah($order->getVerifiedPayments()) }}</div>
            </div>

            <div class="flex justify-between py-2 font-semibold">
                <div>Sisa Pembayaran</div>
                <div>{{ $order->getRemainingPayment() === 0 ? '-' : rupiah($order->getRemainingPayment()) }}</div>
            </div>
        </div>
    </div>
</div>
