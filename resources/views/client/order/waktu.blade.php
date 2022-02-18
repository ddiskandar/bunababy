<x-client-layout>

<div class="py-8 bg-bunababy-50">
    <div class="container px-4 mx-auto sm:px-12">
        waktu
    </div>
</div>

<div class="container gap-12 px-4 py-6 mx-auto sm:px-12 lg:flex">

    <div class="flex-1 mt-4 space-y-4 md:mt-0">
        <x-panel>
            <div class="py-4">
                <x-title>Hari/Tanggal</x-title>
                <div class="text-lg font-semibold">{{ session('selectedDate')->isoFormat('dddd, D MMMM G') }}</div>
            </div>

            <div class="py-4">
                @livewire('select-time')
            </div>
        </x-panel>
        <x-panel>
            <div class="py-4">
                <x-title>Katalog Treatment</x-title>

                <div class="w-full mx-auto bg-white border border-gray-200 rounded" x-data="{selected:1}">
                    <ul class="shadow-box">
                        <li class="relative border-b border-gray-200">
                            <button type="button" class="w-full px-6 py-4 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-bunababy-200">Bunababy Class</span>
                                    <span :class=" selected == 1 ? 'rotate-45' : ''" class="transition-all duration-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </span>
                                </div>
                            </button>

                            <div class="relative overflow-hidden transition-all duration-700 max-h-0" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                <div class="px-6 pb-6">
                                    <ul class="grid gap-4 xl:grid-cols-2">
                                        <li class="p-6 text-sm border rounded border-slate-200">
                                            <div class="font-semibold">Baby Spa</div>
                                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="font-semibold">Rp150.000</div>
                                                <div class="px-4 py-1 text-xs text-white rounded-full bg-bunababy-200">Tambah</div>
                                            </div>
                                        </li>
                                        <li class="p-6 text-sm border rounded border-slate-200">
                                            <div class="font-semibold">Baby Spa</div>
                                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="font-semibold">Rp150.000</div>
                                                <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                            </div>
                                        </li>
                                        <li class="p-6 text-sm border rounded border-slate-200">
                                            <div class="font-semibold">Baby Spa</div>
                                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="font-semibold">Rp150.000</div>
                                                <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>


                        <li class="relative border-b border-gray-200">
                            <button type="button" class="w-full px-6 py-4 text-left" @click="selected !== 2 ? selected = 2 : selected = null">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-bunababy-200">Baby Treatment</span>
                                    <span :class=" selected == 2 ? 'rotate-45' : ''" class="transition-all duration-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </span>
                                </div>
                            </button>

                            <div class="relative overflow-hidden transition-all duration-700 max-h-0" style="" x-ref="container2" x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
                                <div class="px-6 pb-6">
                                    <ul class="grid gap-4 xl:grid-cols-2">
                                        <li class="p-6 text-sm border rounded border-slate-200">
                                            <div class="font-semibold">Baby Spa</div>
                                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="font-semibold">Rp150.000</div>
                                                <div class="px-4 py-1 text-xs text-white rounded-full bg-bunababy-200">Tambah</div>
                                            </div>
                                        </li>
                                        <li class="p-6 text-sm border rounded border-slate-200">
                                            <div class="font-semibold">Baby Spa</div>
                                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="font-semibold">Rp150.000</div>
                                                <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                            </div>
                                        </li>
                                        <li class="p-6 text-sm border rounded border-slate-200">
                                            <div class="font-semibold">Baby Spa</div>
                                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="font-semibold">Rp150.000</div>
                                                <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>


                        <li class="relative border-b border-gray-200">
                            <button type="button" class="w-full px-6 py-4 text-left" @click="selected !== 3 ? selected = 3 : selected = null">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-bunababy-200">Buna Treatment</span>
                                    <span :class=" selected == 3 ? 'rotate-45' : ''" class="transition-all duration-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </span>
                                </div>
                            </button>

                            <div class="relative overflow-hidden transition-all duration-700 max-h-0" style="" x-ref="container3" x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
                                <div class="px-6 pb-6">
                                    <ul class="grid gap-4 xl:grid-cols-2">
                                        <li class="p-6 text-sm border rounded border-slate-200">
                                            <div class="font-semibold">Baby Spa</div>
                                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="font-semibold">Rp150.000</div>
                                                <div class="px-4 py-1 text-xs text-white rounded-full bg-bunababy-200">Tambah</div>
                                            </div>
                                        </li>
                                        <li class="p-6 text-sm border rounded border-slate-200">
                                            <div class="font-semibold">Baby Spa</div>
                                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="font-semibold">Rp150.000</div>
                                                <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                            </div>
                                        </li>
                                        <li class="p-6 text-sm border rounded border-slate-200">
                                            <div class="font-semibold">Baby Spa</div>
                                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="font-semibold">Rp150.000</div>
                                                <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </li>

                    </ul>
                </div>
            </div>
        </x-panel>
    </div>
    <div class="mt-6 lg:w-96 lg:flex-initial lg:mt-0">
        <x-panel>
            <div class="py-6">
                <x-title>Bidan Anda</x-title>
                <div class="flex items-center">
                    {{-- <img src="https://source.unsplash.com/mEZ3PoFGs_k/64x64" alt="User Avatar" class="inline-block w-10 h-10 rounded-full" /> --}}
                    <div class="ml-2">{{ \App\Models\User::where('id', session('midwifeId'))->value('name') }}</div>
                </div>
            </div>

            <div class="py-6">
                <x-title>Tempat</x-title>
                <label class="flex items-center">
                    <input type="radio" class="w-4 h-4 border border-gray-200 text-bunababy-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" checked />
                    <div class="ml-4">
                        <span class="font-semibold">Homecare</span>
                        <div class="text-sm">Di rumah sesuai alamat lokasi</div>
                    </div>
                </label>
            </div>

            <div class="py-6">
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
                <div class="w-full py-4 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50">
                    Lanjut ke Data Pemesan
                </div>
            </div>


        </x-panel>
    </div>
</div>

<x-menubar/>

</x-client-layout>
