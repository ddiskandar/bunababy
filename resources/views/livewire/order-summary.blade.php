<div class="">
    <div class="inline-flex items-center mb-4 text-bunababy-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
        </svg>
        <span class="ml-2 text-lg font-semibold">Order Summary</span>
    </div>

    <div class="rounded shadow-xl shadow-bunababy-100/20">
        <x-panel>
            <div class="py-4">
                <x-title>Bidan Anda</x-title>
                <div class="flex items-center">
                    <img src="/images/default.jpg" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" />
                    <div class="ml-2 font-semibold">{{ $nama_bidan }}</div>
                </div>
            </div>

            <div class="py-4">
                <x-title>Tempat</x-title>
                <label class="flex items-center">
                    <input type="radio" class="w-4 h-4 border border-bunababy-50 text-bunababy-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" checked />
                    <div class="ml-4">
                        <span class="font-semibold">Homecare</span>
                        <div class="text-sm">{{ $nama_kecamatan }}</div>
                    </div>
                </label>
            </div>

            <div class="py-4">
                <x-title>Tanggal dan Waktu</x-title>
                <div class="">
                    <div class="font-semibold">{{ session('order.date')->isoFormat('dddd, D MMMM G') }}</div>
                    <div class="text-sm"></div>
                </div>
            </div>

            <div class="py-4">
                <x-title>Treatment</x-title>
                <ul class="-mt-4 divide-y divide-bunababy-50">
                    <li class="py-4 text-sm">
                        <div class="font-semibold">Baby Spa</div>
                        <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                        <div class="flex justify-between py-2">
                            <div>1 x Rp150.000</div>
                            <div class="font-semibold">Rp150.000</div>
                        </div>
                        <button class="text-red-500">Hapus</button>
                    </li>
                    <li class="py-4 text-sm">
                        <div class="font-semibold">Transportasi</div>
                        <div class="text-slate-400">Cimahi ke Cibeunying Kaler</div>
                        <div class="flex justify-between py-2">
                            <div>1 x Rp30.000</div>
                            <div class="font-semibold">Rp30.000</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="flex items-center justify-between py-6 text-lg font-semibold">
                <div>Total Pembayaran</div>
                <div>Rp190.000</div>
            </div>

            <div class="py-6">
                <button class="w-full py-4 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50">
                    Lanjut ke Data Pemesan
                </button>
            </div>
        </x-panel>
    </div>
</div>
