@if (! $isPaid)
<div class="mt-2">
    @if (!$hasPayments)
        <div class="text-sm">Besar Pembayaran DP (50%)</div>
        <div class="flex items-center justify-between mb-4 ">
            <div class="text-3xl font-semibold text-red-600">{{ rupiah($order->getDpAmount()) }}</div>
            <div class="flex items-center gap-2 cursor-pointer text-bunababy-200" x-data x-on:click="
                window.navigator.clipboard.writeText({{ $order->getDpAmount() }});
                new Notification()
                    .success()
                    .title('Copied')
                    .duration(3000)
                    .send();
                ">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                    <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                </svg>
                <span>Salin</span>
            </div>
        </div>

        <div class="text-sm">Total Keseluruhan Yang Harus Dibayar</div>
        <div class="flex items-center justify-between mb-4 ">
            <div class="text-3xl font-semibold text-red-600">{{ rupiah($order->getGrandTotal()) }}</div>
            <div class="flex items-center gap-2 cursor-pointer text-bunababy-200" x-data x-on:click="
                window.navigator.clipboard.writeText({{ $order->getGrandTotal() }});
                new Notification()
                    .success()
                    .title('Copied')
                    .duration(3000)
                    .send();
                ">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                    <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                </svg>
                <span>Salin</span>
            </div>
        </div>

        <div class="text-sm">Silahkan untuk segera melakukan pembayaran di ATM atau Internet Banking sebelum</div>
        <div class="mt-1 mb-4 font-semibold">{{ $order->created_at->addMinutes($options->timeout)->isoFormat('dddd, D MMMM G HH:mm') }} WIB</div>
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
        <div class="flex items-center justify-between mb-4 ">
            <div class="font-semibold">
                {{ $order->no_reg }}
            </div>
            <div class="flex items-center gap-2 cursor-pointer text-bunababy-200" x-data x-on:click="
                window.navigator.clipboard.writeText({{ $order->no_reg }});
                new Notification()
                    .success()
                    .title('Copied')
                    .duration(3000)
                    .send();
                ">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                    <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                </svg>
                <span>Salin</span>
            </div>
        </div>
        <div class="text-sm">pada kolom berita transfer.</div>
    </div>

    <div class="text-sm">Pastikan untuk segera upload bukti transfer setelah melakukan pembayaran</div>
</div>
@endif
