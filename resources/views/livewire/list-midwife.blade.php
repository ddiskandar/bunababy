<div>
    <div class="mb-4 font-semibold lg:text-lg">Cari Jadwal Bidan untuk {{ $kecamatan->name }}</div>
    <div class="space-y-4">
        @foreach ($kecamatan->midwives as $midwife)
            @livewire('select-midwife', [
                'midwife_user_id' => $midwife->id
            ])
        @endforeach

        @foreach ($midwives as $midwife)
            <div class="p-4 border rounded border-slate-100">
                <div class="">
                    <div class="flex items-center">
                        <img src="/images/default.jpg" alt="User Avatar" class="inline-block grayscale w-10 h-10 rounded-full" />
                        <div class="ml-4 ">
                            <div class="text-xl text-slate-400 font-semibold">{{ $midwife->name }}</div>
                            <div class="text-xs text-slate-400">Wilayah anda bukan jangkauan bidan ini</div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>
