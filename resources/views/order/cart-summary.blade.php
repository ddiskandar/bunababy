<div>
    <h3 class="text-lg font-semibold">Order Summary</h3>

    <div class="rounded shadow-xl shadow-bunababy-100/20">
        @if (session('order.place') == 1)
            <div class="py-4">
                <div class="leading-loose mb-2 text-sm font-semibold">
                    Bidan
                </div>
                <div class="flex items-center">
                    <img src="{{ $data['bidan_photo'] }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
                    <div class="ml-2 font-semibold">{{ $data['bidan'] }}</div>
                </div>
            </div>
            @endif

            <div class="py-4">
                <div class="leading-loose mb-2 text-sm font-semibold">
                    Tempat
                </div>
                <label class="flex items-center">
                    <input type="radio" class="w-4 h-4 border border-bunababy-50 text-bunababy-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" checked />
                    <div class="ml-4">
                        @if (session('order.place') == 1)
                            <span class="font-semibold">Homecare</span>
                            <div class="text-sm opacity-80">{{ $data['kecamatan'] }}</div>
                        @else
                            <span class="font-semibold">Onsite</span>
                            <div class="text-sm opacity-80">Di Klinik bunababy</div>
                        @endif
                    </div>
                </label>
            </div>

            <div class="py-4">
                <div class="leading-loose mb-2 text-sm font-semibold">
                    Tanggal dan Waktu
                </div>
                <div>
                    <div class="font-semibold">{{ $data['date'] }}</div>
                    @if (session()->has('order.treatments'))
                        <div class="text-sm opacity-80">{{ $data['time']  }} ( {{ session('order.addMinutes') }} menit )</div>
                    @endif
                </div>
            </div>

            @if (session()->has('order.treatments'))
            <div class="pt-4">
                <div class="leading-loose mb-2 text-sm font-semibold">
                    Treatment
                </div>
                <ul class="-mt-4 divide-y divide-bunababy-50">
                    @forelse ($treatments as $name => $treatment)
                        <li class="py-4 text-sm opacity-80">
                            <div class="font-semibold">{{ $name }}</div>
                            <div class="truncate">
                                @foreach ($treatment as $pemesan)
                                    <span>{{ $pemesan['family_name'] }}</span>@if(!$loop->last)<span>, </span>@endif
                                @endforeach
                            </div>
                            <div class="flex justify-between py-2">
                                <div>{{ $treatment->count() }} x {{ rupiah($treatment[0]['treatment_price']) }}</div>
                                <div class="font-semibold">{{ rupiah($treatment->sum('treatment_price')) }}</div>
                            </div>
                            <button
                                wire:click="deleteTreatments({{ $treatment[0]['treatment_id'] }})"
                                class="text-red-700">
                                Hapus
                            </button>

                        </li>
                    @empty
                    <li class="py-4">
                        <div class="text-sm text-red-500">Belum ada yang dipilih</div>
                    </li>
                    @endforelse

                    <li class="py-4 text-sm">
                        <div class="flex justify-between py-2">
                            <div class="font-semibold">Sub Total</div>
                            <div class="font-semibold">{{ $data['total_price'] }}</div>
                        </div>
                    </li>
                    <li class="py-4 text-sm">
                        <div class="flex justify-between py-2">
                            <div class="font-semibold">Transport</div>
                            <div class="font-semibold">{{ $data['total_transport'] }}</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="flex items-center justify-between py-6 text-lg font-semibold">
                <div>Total Pembayaran</div>
                <div>{{ $data['grand_total'] }}</div>
            </div>

            <div class="py-6">
                @if (session()->has('treatments'))
                    <div class="mb-4 text-sm text-red-600">{{ session('treatments') }}</div>
                @endif

                <x-button-lg wire:click="checkout" wire:loading.attr="disabled">
                    <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="7 7 12 12 7 17"></polyline>
                            <polyline points="13 7 18 12 13 17"></polyline>
                         </svg>
                        <span class="ml-2 font-semibold">Continue</span>
                    </div>
                </x-button-lg>
            </div>
            @endif
    </div>
</div>
