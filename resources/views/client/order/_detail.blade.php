<x-panel>
    <div class="flex items-center justify-between ">
        <div>
            <x-title>ID Transaksi</x-title>
            <div class="font-semibold">{{ $order->no_reg }}</div>
        </div>
        <div class="flex items-center text-bunababy-200">
            <a href="{{ route('order.invoice', $order->no_reg) }}" target="_blank"
                class="block w-full py-2 text-sm text-center"
            >
                Download Invoice
            </a>
            <svg width="24" height="24" class="ml-2" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.75 6.75L19.25 12L13.75 17.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H4.75"></path>
            </svg>

        </div>
    </div>
</x-panel>

@if (! $order->isPaid())
<div class="flex flex-col px-4 py-4 border divide-y rounded md:px-8 border-bunababy-100">
    <div>
        @if (!$order->payments()->exists())
            <div class="text-sm">Besar Pembayaran DP (50%)</div>
            <div class="mb-4 text-3xl font-semibold text-red-600">{{ rupiah($order->getDpAmount()) }}</div>

            <div class="text-sm">Silahkan untuk segera melakukan pembayaran di ATM atau Internet Banking sebelum</div>
            <div class="mt-1 mb-4 font-semibold">{{ $order->created_at->addMinutes(30)->isoFormat('dddd, D MMMM G HH:mm') }}</div>
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

        <div class="text-sm">Kode Referensi</div>
        <div class="mb-4 font-semibold">
            <div>
                {{ $order->no_reg }}
            </div>
        </div>
    </div>
</div>
@endif
