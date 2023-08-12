<div>
    @if (session()->has('order.kecamatan_id'))
        <x-title>Cari Jadwal Bidan untuk {{ $kecamatan->name }}</x-title>
        <div class="space-y-4">
            @foreach ($midwives['available'] as $midwife)
                @livewire('client.order.select-midwife-available-date', ['midwife_user_id' => $midwife->id, 'slots' => $slots], key($midwife->id))
            @endforeach

            @foreach ($midwives['notAvailable'] as $midwife)
                <div class="px-4 py-2 border rounded border-slate-100">
                    <div>
                        <div class="flex items-center">
                            <img src="{{ $midwife->profile_photo_url }}" alt="User Avatar"
                                class="inline-block w-10 h-10 rounded-full grayscale" />
                            <div class="ml-4 ">
                                <div class="font-semibold text-slate-400">{{ $midwife->name }}</div>
                                <div class="text-xs text-slate-400">Wilayah anda bukan jangkauan bidan ini</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-12">
            <img src="{{ asset('/images/undraw_search_re_x5gq.svg') }}" class="w-48 " alt="search">
            <div class="py-8 text-center">
                <div class="mb-2 font-semibold text-brand-400">Pilih Jadwal Bidan Tersedia</div>
                <div class="text-sm text-slate-600 ">Mulai dengan memilih tempat dan lokasi treatment.</div>
            </div>
        </div>
    @endif

</div>
