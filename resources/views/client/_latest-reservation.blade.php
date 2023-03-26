<div>
    <x-title class="mb-4">Treatment anda</x-title>

    @livewire('client.card-order', ['reservation' => $reservation])

    <div class="mt-4">
        <a href="{{ route('client.history') }}" class="text-sm text-brand-200">Lihat semua riwayat reservasi</a>
    </div>
</div>
