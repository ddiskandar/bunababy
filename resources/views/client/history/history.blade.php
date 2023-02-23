<div class="relative">
    <div class="sticky top-0 z-20 px-4 py-4 text-white shadow bg-bunababy-200 shadow-bunababy-50">
        <div class="flex items-center justify-between max-w-screen-sm mx-auto">
            <a href="{{ route('client.profile') }}">
                <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                </svg>
            </a>
            <h1 class="flex-1 font-semibold md:text-center">Riwayat Reservasi</h1>
        </div>
    </div>

    <div class="max-w-screen-sm min-h-screen mx-auto my-0">
        <div class="flex flex-wrap justify-center gap-2 py-4 ">
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

        <div class="px-6 py-4">
            @forelse ($reservations as $reservation)
                @livewire('client.card-order', ['reservation' => $reservation], key($reservation->id))
            @empty
                <div class="w-full py-16 font-semibold text-center">Tidak ada Riwayat</div>
            @endforelse

        </div>

    </div>

</div>
