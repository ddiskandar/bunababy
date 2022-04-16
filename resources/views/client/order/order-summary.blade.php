<div class="sticky top-28 ">
    <div class="inline-flex items-center mb-4 lg:hidden text-bunababy-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
        </svg>
        <span class="ml-2 text-lg font-semibold">Ringkasan</span>
    </div>

    <div class="rounded shadow-xl shadow-bunababy-100/20">
        <x-panel>
            <div class="py-4">
                <x-title>Bidan </x-title>
                <div class="flex items-center">
                    <img src="{{ $data['bidan_photo'] }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
                    <div class="ml-2 font-semibold">{{ $data['bidan'] }}</div>
                </div>
            </div>

            <div class="py-4">
                <x-title>Tempat</x-title>
                <label class="flex items-center">
                    <input type="radio" class="w-4 h-4 border border-bunababy-50 text-bunababy-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" checked />
                    <div class="ml-4">
                        @if (session('order.place') == 1)
                            <span class="font-semibold">Homecare</span>
                            <div class="text-sm">{{ $data['kecamatan'] }}</div>
                        @else
                            <span class="font-semibold">Onsite</span>
                            <div class="text-sm">Di Klinik bunababy</div>
                        @endif
                    </div>
                </label>
            </div>

            <div class="py-4">
                <x-title>Tanggal dan Waktu</x-title>
                <div class="">
                    <div class="font-semibold">{{ $data['date'] }}</div>
                    @if (session()->has('order.treatments'))
                        <div class="text-sm">{{ Str::substr($data['start_time'], 0, 5 )  }} - {{ Str::substr($data['end_time'], 0, 5 )  }} WIB ( {{ session('order.addMinutes') }} menit )</div>
                    @endif
                </div>
            </div>

            <div class="py-4">
                <x-title>Treatment</x-title>
                <ul class="-mt-4 divide-y divide-bunababy-50">
                    @forelse ($treatments as $key => $treatment)
                        <li class="py-4 text-sm">
                            <div class="font-semibold">{{ $key }}</div>
                            <div class="truncate text-slate-400 ">
                                @foreach ($treatment as $pemesan)
                                    <span>{{ $pemesan['family_name'] }}</span>
                                @endforeach
                            </div>
                            <div class="flex justify-between py-2">
                                <div>{{ $treatment->count() }} x {{ rupiah($treatment[0]['treatment_price']) }}</div>
                                <div class="font-semibold">{{ rupiah($treatment->sum('treatment_price')) }}</div>
                            </div>
                            @if (Route::is('order.step-2'))
                            <button
                                wire:click="deleteTreatments({{ $treatment[0]['treatment_id'] }})"
                                class="text-red-500">
                                Hapus
                            </button>
                            @endif

                        </li>
                    @empty
                    <li class="py-4 text-sm">
                        <div class="font-semibold">Belum dipilih</div>
                    </li>
                    @endforelse


                    <li class="py-4 text-sm">
                        <div class="flex justify-between py-2">
                            <div class="font-semibold">Transport</div>
                            <div class="font-semibold">{{ rupiah($data['total_transport']) }}</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="flex items-center justify-between py-6 text-lg font-semibold">
                <div>Total Pembayaran</div>
                <div>{{ rupiah($data['grand_total']) }}</div>
            </div>

            @if (Route::is('order.step-3'))

            <div class="py-6">
                <button
                    wire:click="confirm"
                    class="block w-full py-4 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50">
                    Konfirmasi
                </button>
            </div>

            @else

            <div class="py-6">
                <a href="{{ route('order.step-3') }}" class="block w-full py-4 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50">
                    Lanjut ke Data Pemesan
                </a>
            </div>

            @endif

        </x-panel>
    </div>
</div>
