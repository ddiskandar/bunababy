<div>
    <div class="space-y-2">
        @if (session('order.place_id') == 1)
            <x-section>
                <x-title>Bidan </x-title>
                <div class="flex items-center">
                    <img src="{{ $data['bidan_photo'] }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
                    <div class="ml-2 font-semibold">{{ $data['bidan'] }}</div>
                </div>
            </x-section>
        @endif

        <x-section>
            <x-title>Tempat</x-title>
            <label class="flex items-center">
                <input type="radio" class="w-4 h-4 border border-bunababy-50 text-bunababy-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" checked />
                <div class="ml-4">
                    @if (session('order.place_id') == 1)
                        <span class="font-semibold">Homecare</span>
                        <div class="text-sm">{{ $data['kecamatan'] }}</div>
                    @else
                        <span class="font-semibold">Onsite</span>
                        <div class="text-sm">Di Klinik bunababy</div>
                    @endif
                </div>
            </label>
        </x-section>

        <x-section>
            <x-title>Tanggal dan Waktu</x-title>
            <div  >
                <div class="font-semibold">{{ $data['date'] }}</div>
                @if (session()->has('order.treatments'))
                    <div class="text-sm">{{ $data['time']  }}</div>
                @endif
            </div>
        </x-section>

        <x-section>
            <x-title>Treatment</x-title>
            <ul class="">
                @forelse ($treatments as $name => $treatment)
                    <li class="py-1 text-sm">
                        <div class="font-semibold">{{ $name }}</div>
                        <div class="truncate text-slate-400 ">
                            @foreach ($treatment as $pemesan)
                                <span>{{ $pemesan['family_name'] }}</span>@if(!$loop->last)<span>, </span>@endif
                            @endforeach
                        </div>
                        <div class="flex justify-between py-2">
                            <div>{{ $treatment->count() }} x {{ rupiah($treatment[0]['treatment_price']) }}</div>
                            <div>{{ rupiah($treatment->sum('treatment_price')) }}</div>
                        </div>

                    </li>
                @empty
                <li class="py-1">
                    <div class="text-sm text-red-500">Belum ada yang dipilih</div>
                </li>
                @endforelse

                <li class="py-1 text-sm">
                    <div class="flex justify-between ">
                        <div>Sub Total</div>
                        <div>{{ $data['total_price'] }}</div>
                    </div>
                </li>
                <li class="py-1 text-sm">
                    <div class="flex justify-between ">
                        <div>Transport</div>
                        <div>{{ $data['total_transport'] }}</div>
                    </div>
                </li>
                <li class="py-1 text-sm">
                    <div class="flex items-center justify-between text-lg font-semibold">
                        <div>Total Pembayaran</div>
                        <div>{{ $data['grand_total'] }}</div>
                    </div>
                </li>
            </ul>
        </x-section>
    </div>
</div>
