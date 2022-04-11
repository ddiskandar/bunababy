<x-client-layout>
    <div class="sticky top-0 py-3 bg-white border-b z-20 border-bunababy-50 ">
        <div class="container flex items-center justify-between px-4 mx-auto sm:px-12">
            <div>
                <a href="/"><img src="/images/logo.svg" alt="Logo"></a>
            </div>
        </div>
    </div>
    <div class="container px-4 py-4 mx-auto md:py-10 sm:px-12 ">
        <div class="font-semibold text-xl text-bunababy-400">
            Hi, {{ auth()->user()->name }}
        </div>
        <div class="py-2">
            <p class="text-slate-400 text-sm">Nomor WA</p>
            <p class="font-semibold">{{ auth()->user()->profile->phone }}</p>
        </div>

        @livewire('treatments-catalog')

        <div class="py-4">
            <div class="font-semibold mb-4">Treatment anda</div>

            @if ($reservation)
                <div class="p-6 border max-w-lg border-bunababy-50 rounded shadow-lg shadow-bunababy-50">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-2">
                        <div class="order-2 md:order-1 mt-4 md:mt-0 text-sm">
                            <div>{{ $reservation->date->isoFormat('dddd, DD MMMM Y') }}</div>
                            <div class="">{{ substr($reservation->start_time, 0, 5) . ' - ' . substr($reservation->end_time, 0, 5) }} WIB</div>
                        </div>
                        <div class="order-1 md:order-2">
                            <div @class([
                                'inline-flex px-6 py-1 leading-4 text-xs rounded-full',
                                'text-orange-700 bg-orange-200' => $reservation->status == '1',
                                'text-green-700 bg-green-200' => $reservation->status == '2',
                                'text-blue-700 bg-blue-200' => $reservation->status == '3',
                            ])>{{ $reservation->status() }}</div>
                        </div>
                    </div>
                    <div>
                        <span class="font-semibold">{{ $reservation->place() }}</span>
                        @foreach ($reservation->treatments as $treatment)
                        <span class="font-semibold">{{ $treatment->name }}</span>
                        @endforeach
                    </div>
                    <div class="md:flex md:items-center md:justify-between mt-4">
                        <div>
                            <div class="text-sm">Total Pembayaran</div>
                            <div class="font-bold">{{ rupiah($reservation->grand_total()) }}</div>
                        </div>
                        <div class="mt-6 md:mt-0">
                            @if ($reservation->status == '1')
                                <a href="{{ route('order.show', $reservation->no_reg) }}" class="py-2 font-bold px-10 border-2 hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200  text-bunababy-200 rounded-full">
                                    Bayar DP
                                </a>
                            @elseif ($reservation->status == '2')
                                <a href="{{ route('order.show', $reservation->no_reg) }}" class="py-2 font-bold px-10 border-2 hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200  text-bunababy-200 rounded-full">
                                    Lunasi Pembayaran
                                </a>
                            @else

                                @if ($reservation->testimonial()->exists())
                                    <a href="{{ route('order.show', $reservation->no_reg) }}" class="py-2 font-bold px-10 border-2 hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200  text-bunababy-200 rounded-full">
                                        Lihat Ulasan
                                    </a>
                                @else
                                    <a href="{{ route('order.show', $reservation->no_reg) }}" class="py-2 font-bold px-10 border-2 hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200  text-bunababy-200 rounded-full">
                                        Isi Ulasan
                                    </a>
                                @endif

                            @endif
                        </div>
                    </div>
                </div>

            @else
                <div>Belum ada</div>
                <div>Buat Order Sekarang</div>
            @endif
        </div>

    </div>

</x-client-layout>
