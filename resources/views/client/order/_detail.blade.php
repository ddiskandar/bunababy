<x-panel>
    <div>
        <div class="flex items-center justify-between mb-4">
            <div  >
                <x-title>ID Transaksi</x-title>
                <div class="font-semibold">{{ $order->no_reg }}</div>
                {{-- <p class="text-xs">Harap inputkan ID Transaksi di nomor referensi atau pesan pada proses transfer.</p> --}}
            </div>
            <div @class([
                    'inline-flex px-6 py-1 leading-4 text-xs rounded-full',
                    'text-orange-700 bg-orange-200' => $order->status == '1',
                    'text-green-700 bg-green-200' => $order->status == '2',
                    'text-blue-700 bg-blue-200' => $order->status == '3',
                ])
            >{{ $order->status() }}</div>

        </div>

        <x-title>Minimal Pembayaran DP</x-title>
        <div class="mb-4 font-semibold">{{ rupiah($order->getDpAmount()) }}</div>

        <x-title>Total Tagihan</x-title>
        <div class="mb-4 font-semibold">{{ rupiah($order->getGrandTotal()) }}</div>

        <x-title>Batas Akhir Pembayaran</x-title>
        <div class="mb-4 font-semibold">{{ $order->created_at->addMinutes(30)->isoFormat('dddd, D MMMM G HH:mm') }}</div>

        <x-title>Pembayaran melalui</x-title>
        <div class="mb-4 font-semibold">BCA 2810417067<br>a/n Febrianti Nur Azizah</div>

    </div>

    <div class="py-6">
        <a href="{{ route('order.invoice', $order->no_reg) }}" target="_blank"
            class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
            >Download Invoice</a>
    </div>
</x-panel>
