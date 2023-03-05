<div>
    <div class="space-y-2">
        <x-section>
            <x-title>Tempat</x-title>
            <div>
                <span class="font-semibold">{{ session('order.place_type') === \App\Models\Place::TYPE_CLINIC ? $place->name . ', ' . $room->name : $place->name }}</span>
                <div class="text-sm">{{ $place->desc }}</div>
            </div>
        </x-section>

        @if (session('order.place_type') === \App\Models\Place::TYPE_HOMECARE)
            <x-section>
                <x-title>Bidan </x-title>
                <div class="flex items-center">
                    <img src="{{ $data['midwife_photo'] }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
                    <div class="ml-2 font-semibold">{{ $data['midwife'] }}</div>
                </div>
            </x-section>
        @endif

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
                @if (session('order.place_type') === \App\Models\Place::TYPE_HOMECARE)
                <li class="py-1 text-sm">
                    <div class="flex justify-between ">
                        <div>Transport</div>
                        <div>{{ $data['total_transport'] }}</div>
                    </div>
                </li>
                @endif
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
