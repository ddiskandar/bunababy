@if (! $isPaid)
<div class="mt-2">
    @if (!$hasPayments)
        <div class="text-sm">Besar Pembayaran DP (50%)</div>
        <div class="mb-4 text-3xl font-semibold text-red-600">{{ rupiah($order->getDpAmount()) }}</div>

        <div class="text-sm">Total Keseluruhan Yang Harus Dibayar</div>
        <div class="mb-4 text-3xl font-semibold text-red-600">{{ rupiah($order->getGrandTotal()) }}</div>

        <div class="text-sm">Silahkan untuk segera melakukan pembayaran di ATM atau Internet Banking sebelum</div>
        <div class="mt-1 mb-4 font-semibold">{{ $order->created_at->addMinutes(\DB::table('options')->select('timeout')->first()->timeout)->isoFormat('dddd, D MMMM G HH:mm') }} WIB</div>
        @else
        <div class="text-sm">Sisa Pembayaran</div>
        <div class="mb-4 text-3xl font-semibold text-red-600">{{ rupiah($order->getRemainingPayment()) }}</div>
        <div class="mb-4 text-sm">Silahkan untuk segera melakukan pembayaran di ATM atau Internet Banking</div>
    @endif

    <div class="text-sm">Pembayaran melalui</div>
    <div class="mb-4 font-semibold">
        <div>
            {{ $options->account }}
        </div>
        <div>
            {{ $options->account_name }}
        </div>
    </div>

    <div class="mb-4 ">
        <div class="text-sm">Mohon tuliskan berita / referensi :</div>
        <div class="font-semibold">
            <div>
                {{ $order->no_reg }}
            </div>
        </div>
        <div class="text-sm">pada kolom berita transfer.</div>
    </div>

    <div class="text-sm">Pastikan untuk segera upload bukti transfer setelah melakukan pembayaran</div>
</div>
@endif
