<x-client-layout>

    <div class="container px-4 py-4 mx-auto md:py-10 sm:px-12 ">
        <div class="font-semibold text-2xl mb-12 text-bunababy-400">
            Hai, {{ auth()->user()->name }}
        </div>

        <div class="py-4">
            <div class="font-semibold mb-4">Reservasi</div>

            @if ($reservation)
            <div class="p-6 border max-w-xl border-slate-200 rounded-2xl bg-slate-50">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-2">
                    <div class="order-2 md:order-1 mt-4 md:mt-0">
                        <div class="font-semibold">{{ $reservation->place() }}</div>
                        <span>{{ $reservation->date->isoFormat('DD MMMM Y') }}, </span>
                        <span class="">{{ $reservation->start_time . ' - ' . $reservation->end_time }} WIB</span>
                    </div>
                    <div class="order-1 md:order-2">
                        <div class="font-semibold inline-flex px-4 py-1 leading-4 text-sm rounded-full text-orange-700 bg-orange-200">{{ $reservation->status() }}</div>
                    </div>
                </div>
                @foreach ($reservation->treatments as $treatment)
                    <div class="font-bold">{{ $treatment->name }}</div>
                @endforeach
                <div class="">{{ $reservation->midwife->name }}</div>
                <div class="md:flex md:items-center md:justify-between mt-4">
                    <div>
                        <div class="text-sm">Total Pembayaran</div>
                        <div class="font-bold">{{ rupiah($reservation->total_price) }}</div>
                    </div>
                    <div class="mt-6 md:mt-0">
                        <a href="{{ route('order.show', $reservation->id) }}" class="py-1 px-6 border hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 text-sm text-bunababy-200 rounded-full">Bayar DP</a>
                    </div>
                </div>
            </div>

            @else
                <div>Belum ada</div>
                <div>Buat Order Sekarang</div>
            @endif
        </div>
        <div class="py-4">
            <div>Katalog Treatment</div>
            <div></div>
        </div>
    </div>

</x-client-layout>
