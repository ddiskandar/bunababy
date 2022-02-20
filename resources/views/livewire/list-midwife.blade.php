<div>
    <div class="mb-4 font-semibold lg:text-lg">Cari Jadwal Bidan untuk {{ $kecamatan->name }}</div>
    <div class="space-y-4">
    {{-- @dd($kecamatan) --}}
    @forelse ($kecamatan->midwives as $midwife)
                @livewire('select-midwife', [
                    'midwife_user_id' => $midwife->id
                ])
    @empty
        <div>Tidak ada</div>
    @endforelse
    </div>

</div>
