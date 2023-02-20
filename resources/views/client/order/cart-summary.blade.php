<div x-data="{show: false}" class="fixed max-w-screen-sm w-full z-10 bottom-0 px-6 py-3 text-white bg-bunababy-100">
    <div x-show="show" style="display: none" class="py-2">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">Order Summary</h3>
            <button class="" x-on:click="show = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M18 6l-12 12"></path>
                    <path d="M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="rounded shadow-xl shadow-bunababy-100/20 h-72 px-1 overflow-y-auto">
            @if (session('order.place') == 1)
                <div class="py-4">
                    <div class="mb-2 text-sm font-semibold leading-loose">
                        Bidan
                    </div>
                    <div class="flex items-center">
                        <img src="{{ $data['bidan_photo'] }}" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
                        <div class="ml-2 font-semibold">{{ $data['bidan'] }}</div>
                    </div>
                </div>
                @endif

                <div class="py-4">
                    <div class="mb-2 text-sm font-semibold leading-loose">
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
                    <div class="mb-2 text-sm font-semibold leading-loose">
                        Tanggal dan Waktu
                    </div>
                    <div>
                        <div class="font-semibold">{{ $data['date'] }}</div>
                        @if (session()->has('order.treatments'))
                            <div class="text-sm opacity-80">{{ $data['time']  }}</div>
                        @endif
                    </div>
                </div>

                @if (session()->has('order.treatments'))
                <div class="pt-4">
                    <div class="mb-2 text-sm font-semibold leading-loose">
                        Treatment
                    </div>
                    <ul class="-mt-4 divide-y divide-white">
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

                        <li>
                            <div class="flex text-sm justify-between py-2">
                                <div class="font-semibold">Sub Total</div>
                                <div class="font-semibold">{{ $data['total_price'] }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="flex text-sm justify-between py-2">
                                <div class="font-semibold">Transport</div>
                                <div class="font-semibold">{{ $data['total_transport'] }}</div>
                            </div>
                        </li>
                    </ul>
                </div>

                @if (session()->has('treatments'))
                    <div class="mb-4 text-sm text-red-600">{{ session('treatments') }}</div>
                @endif


                @endif
        </div>
    </div>
    <div class="py-1 flex justify-between relative">
        <div class="w-2/3">
            <div class="">
                <div class="text-sm">Total Pembayaran</div>
                <div class="font-semibold text-xl flex items-center" x-on:click="show = true">
                    <div class="mr-2">{{ $data['grand_total'] }}</div>
                    <button x-show="!show" >
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M6 15l6 -6l6 6"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <button class="ml-2 flex-shrink-0 px-6 py-2 font-semibold text-center text-bunababy-200 transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-white shadow-bunababy-100/50"
            wire:click="checkout"
            wire:loading.attr="disabled"
            @if (!session()->has('order.treatments') || session('order.treatments') === [])
                disabled
            @endif
        >
            Continue
        </button>
    </div>
</div>
