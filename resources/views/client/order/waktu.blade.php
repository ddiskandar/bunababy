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
                <div>{{ session('selectedDate')->isoFormat('dddd, D MMMM G') }}</div>
            </div>

            <div class="py-4">
                @livewire('select-time')
            </div>
        </x-panel>
        <x-panel>
            <div class="py-4">
                <x-title>Katalog Treatment</x-title>
                <x-panel>
                    <div class="pb-2 font-semibold text-bunababy-200">BUNABABY Package</div>
                    <ul class="grid gap-4 py-4 xl:grid-cols-2">
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
                        <li class="p-6 text-sm border rounded border-slate-200">
                            <div class="font-semibold">Baby Spa</div>
                            <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                            <div class="flex items-center justify-between mt-4">
                                <div class="font-semibold">Rp150.000</div>
                                <div class="px-4 py-1 text-xs border rounded-full border-bunababy-200 text-bunababy-200">Tambah</div>
                            </div>
                        </li>
                    </ul>
                </x-panel>
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
                <div>Rumah</div>
            </div>

            <div class="py-6">
                <x-title>Treatment</x-title>
                <ul class="divide-y divide-bunababy-50">
                    <li class="py-4 text-sm">
                        <div class="font-semibold">Baby Spa</div>
                        <div class="text-slate-400">Baby Swim, Baby Massage, Baby Gym</div>
                        <div class="flex justify-between py-2">
                            <div>1 x 150.000</div>
                            <div class="font-semibold">150.000</div>
                        </div>
                        <div class="text-red-500">Hapus</div>
                    </li>
                    <li class="py-4 text-sm">
                        <div class="font-semibold">Transportasi</div>
                        <div class="text-slate-400">Cimahi ke Cibeunying Kaler</div>
                        <div class="flex justify-between py-2">
                            <div>1 x 30.000</div>
                            <div class="font-semibold">30.000</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="flex items-center justify-between py-6 text-lg font-semibold">
                <div>Total Pembayaran</div>
                <div>190.000</div>
            </div>

            <div class="py-6">
                <div class="w-full py-2 text-center text-white rounded-full bg-bunababy-200">
                    Lanjut ke Data Pemesan
                </div>
            </div>


        </x-panel>
    </div>
</div>

<x-menubar/>

</x-client-layout>
