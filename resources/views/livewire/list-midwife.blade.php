<div>
    <div class="mb-4 font-semibold lg:text-lg">Cari Jadwal Bidan</div>
    @forelse ($midwives as $midwife)
        <div class="space-y-4">
                @livewire('select-midwife', [
                    'midwife_user_id' => 2
                ])
        </div>
    @empty
        <div>Tidak ada</div>
    @endforelse

</div>
