<x-client-layout>
    <div class="sticky top-0 z-20 py-3 bg-white border-b border-bunababy-50 ">
        <div class="container flex items-center justify-between px-4 mx-auto sm:px-12">
            <div>
                <a href="/"><img src="/images/logo.svg" alt="Logo"></a>
            </div>
        </div>
    </div>
    <div class="container px-4 py-4 mx-auto md:py-10 sm:px-12 ">
        <div class="text-xl font-semibold text-bunababy-400">
            Hi, {{ auth()->user()->name }}
        </div>
        <div class="py-2">
            <p class="text-sm text-slate-400">Nomor WA</p>
            <p class="font-semibold">{{ auth()->user()->profile->phone }}</p>
        </div>

        @livewire('treatments-catalog')

        <div class="py-4">
            <div class="mb-4 font-semibold">Treatment anda</div>

            @if ($reservation)
                <div class="max-w-lg p-6 border rounded shadow-lg border-bunababy-50 shadow-bunababy-50">
                    <div class="flex flex-col mb-2 md:flex-row md:justify-between md:items-start">
                        <div class="order-2 mt-4 text-sm md:order-1 md:mt-0">
                            <div>{{ $reservation->start_datetime->isoFormat('dddd, DD MMMM Y') }}</div>
                            <div class="">{{ $reservation->start_datetime->isoFormat('hh:mm') . ' - ' . $reservation->start_datetime->isoFormat('hh:mm') }} WIB</div>
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
                    <div class="mt-4 md:flex md:items-center md:justify-between">
                        <div>
                            <div class="text-sm">Total Pembayaran</div>
                            <div class="font-bold">{{ rupiah($reservation->grand_total()) }}</div>
                        </div>
                        <div class="mt-6 md:mt-0">
                            @if ($reservation->status == '1')
                                <a href="{{ route('order.show', $reservation->no_reg) }}" class="px-10 py-2 font-bold transition-all border-2 rounded-full hover:bg-bunababy-200 hover:text-white border-bunababy-200 text-bunababy-200">
                                    Bayar DP
                                </a>
                            @elseif ($reservation->status == '2')
                                <a href="{{ route('order.show', $reservation->no_reg) }}" class="px-10 py-2 font-bold transition-all border-2 rounded-full hover:bg-bunababy-200 hover:text-white border-bunababy-200 text-bunababy-200">
                                    Lunasi Pembayaran
                                </a>
                            @else

                                @if ($reservation->testimonial()->exists())
                                    <a href="{{ route('order.show', $reservation->no_reg) }}" class="px-10 py-2 font-bold transition-all border-2 rounded-full hover:bg-bunababy-200 hover:text-white border-bunababy-200 text-bunababy-200">
                                        Lihat Ulasan
                                    </a>
                                @else
                                    <a href="{{ route('order.show', $reservation->no_reg) }}" class="px-10 py-2 font-bold transition-all border-2 rounded-full hover:bg-bunababy-200 hover:text-white border-bunababy-200 text-bunababy-200">
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
