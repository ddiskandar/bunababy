<div>
    <div class="mb-4 font-semibold lg:text-xl">Cari Jadwal Bidan untuk {{ $kecamatan }}</div>
    <div class="space-y-4">
            @livewire('select-midwife', [
                'midwife_user_id' => 2
            ])
    </div>
</div>
