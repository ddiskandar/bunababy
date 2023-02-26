<div class="relative">
    <div class="sticky top-0 z-20 px-4 py-4 text-white shadow bg-bunababy-200 shadow-bunababy-50">
        <div class="flex items-center justify-between max-w-screen-sm mx-auto">
            <h1 class="flex-1 font-semibold md:text-center">Riwayat Reservasi</h1>
        </div>
    </div>

    <div class="max-w-screen-sm min-h-screen mx-auto my-0">
        <div class="flex flex-wrap justify-center gap-2 py-4 ">
            <button wire:click="$set('filterStatus', '')"
                class="py-1 text-xs font-semibold px-4 border @if($filterStatus == '') bg-bunababy-200 text-white @else text-bunababy-200 bg-white @endif hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full">
                Semua
            </button>
            <button wire:click="$set('filterStatus', '2')"
                class="py-1 text-xs font-semibold px-4 border @if($filterStatus == '2') bg-bunababy-200 text-white @else text-bunababy-200 bg-white @endif hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full">
                Aktif
            </button>
            <button wire:click="$set('filterStatus', '3')"
                class="py-1 text-xs font-semibold px-4 border @if($filterStatus == '3') bg-bunababy-200 text-white @else text-bunababy-200 bg-white @endif hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full">
                Selesai
            </button>
            <button wire:click="$set('filterStatus', '1')"
                class="py-1 text-xs font-semibold px-4 border @if($filterStatus == '1') bg-bunababy-200 text-white @else text-bunababy-200 bg-white @endif hover:bg-bunababy-200 hover:text-white transition-all border-bunababy-200 rounded-full">
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

    <div class="fixed max-w-screen-sm py-3 right-4 bottom-24 z-90">
        <a href="{{ route('order.create') }}"
            class="flex flex-col items-center p-2 border-2 rounded-full cursor-pointer bg-bunababy-200 border-bunababy-200 text-bunababy-200 hover:text-bunababy-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                <line x1="16" y1="3" x2="16" y2="7"></line>
                <line x1="8" y1="3" x2="8" y2="7"></line>
                <line x1="4" y1="11" x2="20" y2="11"></line>
                <line x1="10" y1="16" x2="14" y2="16"></line>
                <line x1="12" y1="14" x2="12" y2="18"></line>
            </svg>
        </a>
    </div>
</div>
