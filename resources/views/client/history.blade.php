<div>
    <div class="py-4 px-4 md:px-6 flex items-center justify-between sticky shadow shadow-bunababy-50">
        <a href="{{ route('profile') }}">
            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
            </svg>
        </a>
        <h1 class="flex-1 md:text-center font-semibold">Riwayat Reservasi</h1>
    </div>

    <div class="max-w-xl px-4 py-6 mx-auto">
        <div class="flex gap-2 justify-center flex-wrap">
            <button wire:click="$set('filterStatus', '')"
                class="py-1 text-xs font-semibold px-4 border @if($filterStatus == '') bg-bunababy-200 text-white @else text-bunababy-200 @endif hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full">
                Semua
            </button>
            <button wire:click="$set('filterStatus', '3')"
                class="py-1 text-xs font-semibold px-4 border @if($filterStatus == '3') bg-bunababy-200 text-white @else text-bunababy-200 @endif hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full">
                Selesai
            </button>
            <button wire:click="$set('filterStatus', '2')"
                class="py-1 text-xs font-semibold px-4 border @if($filterStatus == '2') bg-bunababy-200 text-white @else text-bunababy-200 @endif hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full">
                Aktif
            </button>
            <button wire:click="$set('filterStatus', '1')"
                class="py-1 text-xs font-semibold px-4 border @if($filterStatus == '1') bg-bunababy-200 text-white @else text-bunababy-200 @endif hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full">
                Pending
            </button>
        </div>

        <ul class="py-6">
            @forelse ($reservations as $reservation)
                <li class="p-6 border max-w-lg border-bunababy-50 rounded shadow-lg shadow-bunababy-50">
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
                </li>
            @empty
                <li class="w-full font-semibold py-16 text-center">Tidak ada Riwayat</li>
            @endforelse

        </ul>
    </div>

</div>
