<div>
    @if (session()->has('order.kecamatan_id'))
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
                            <img src="{{ $midwife->photo }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full grayscale" />
                            <div class="ml-4 ">
                                <div class="text-xl font-semibold text-slate-400">{{ $midwife->name }}</div>
                                <div class="text-xs text-slate-400">Wilayah anda bukan jangkauan bidan ini</div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-12">
            <img src="/images/undraw_search_re_x5gq.svg" class="w-48 " alt="search">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg> --}}
            <div class="py-8 text-center">
                <div class="mb-2 font-semibold text-bunababy-400">Pilih Jadwal Bidan Tersedia</div>
                <div class="text-sm text-slate-600 ">Mulai dengan memilih tempat dan lokasi treatment.</div>
            </div>
        </div>
    @endif

</div>
