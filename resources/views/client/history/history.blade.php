<div>
    <div class="sticky flex items-center justify-between px-4 py-4 shadow md:px-6 shadow-bunababy-50">
        <a href="{{ route('client.profile') }}">
            <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
            </svg>
        </a>
        <h1 class="flex-1 font-semibold md:text-center">Riwayat Reservasi</h1>
    </div>

    <div class="max-w-xl px-4 py-6 mx-auto">
        <div class="flex flex-wrap justify-center gap-2">
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
                <li class="max-w-lg p-6 border rounded shadow-lg border-bunababy-50 shadow-bunababy-50">
                    <div class="flex flex-col mb-2 md:flex-row md:justify-between md:items-start">
                        <div class="order-2 mt-4 text-sm md:order-1 md:mt-0">
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
                    <div class="mt-4 md:flex md:items-center md:justify-between">
                        <div>
                            <div class="text-sm">Total Pembayaran</div>
                            <div class="font-bold">{{ rupiah($reservation->getGrandTotal()) }}</div>
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
                </li>
            @empty
                <li class="w-full py-16 font-semibold text-center">Tidak ada Riwayat</li>
            @endforelse

        </ul>
    </div>

</div>
