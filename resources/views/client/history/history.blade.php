<div class="relative">
    <div class="sticky top-0 z-20 px-4 py-4 text-white shadow bg-brand-200 shadow-brand-50">
        <div class="flex items-center justify-between max-w-screen-sm mx-auto">
            <h1 class="flex-1 font-semibold md:text-center">Riwayat Reservasi</h1>
        </div>
    </div>

    {{-- TODO : Filter Status --}}
    <div class="max-w-screen-sm min-h-screen mx-auto my-0">
        <div class="flex flex-wrap justify-center gap-2 py-4 ">
            <button wire:click="$set('filterStatus', '')"
                @class([
                    'py-1 text-xs font-semibold px-4 border hover:bg-brand-200 hover:text-white transition-all border-brand-200 rounded-full',
                    'bg-brand-200 text-white' => $filterStatus === '',
                    'text-brand-200 bg-white' => $filterStatus !== '',
                ])
            >
                Semua
            </button>
            <button wire:click="$set('filterStatus', '2')"
                @class([
                    'py-1 text-xs font-semibold px-4 border hover:bg-brand-200 hover:text-white transition-all border-brand-200 rounded-full',
                    'bg-brand-200 text-white' => $filterStatus === \App\Models\Order::STATUS_LOCKED,
                    'text-brand-200 bg-white' => $filterStatus !== \App\Models\Order::STATUS_LOCKED,
                ])
            >
                Aktif
            </button>
            <button wire:click="$set('filterStatus', '3')"
                @class([
                    'py-1 text-xs font-semibold px-4 border hover:bg-brand-200 hover:text-white transition-all border-brand-200 rounded-full',
                    'bg-brand-200 text-white' => $filterStatus === \App\Models\Order::STATUS_FINISHED,
                    'text-brand-200 bg-white' => $filterStatus !== \App\Models\Order::STATUS_FINISHED,
                ])
            >
                Selesai
            </button>
            <button wire:click="$set('filterStatus', '1')"
                @class([
                    'py-1 text-xs font-semibold px-4 border hover:bg-brand-200 hover:text-white transition-all border-brand-200 rounded-full',
                    'bg-brand-200 text-white' => $filterStatus === \App\Models\Order::STATUS_UNPAID,
                    'text-brand-200 bg-white' => $filterStatus !== \App\Models\Order::STATUS_UNPAID,
                ])
            >
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

    @if (!$hasActiveReservation)
    <div class="fixed inset-x-0 bottom-24 z-90">
        <div class="flex items-center justify-center">
            <a href="{{ route('order.create') }}"
                class="flex items-center px-6 py-2 border-white rounded-full shadow-lg cursor-pointer shadow-brand-200/25 border-3 bg-brand-200 text-brand-200 hover:text-brand-200"
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
                <span class="ml-2 text-xs font-semibold text-white">Buat Reservasi Baru</span>
            </a>
        </div>
    </div>
    @endif
</div>
