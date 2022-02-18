<x-client-layout>

<div class="py-8 bg-bunababy-50">
    <div class="container px-4 mx-auto sm:px-12">
        navbar
    </div>
</div>

<div class="container gap-12 px-4 py-6 mx-auto sm:px-12 md:flex">
    <div class="md:w-80 md:flex-initial ">
        <div class="p-8 border border-bunababy-50 rounded">
            <div class="text-sm font-semibold text-bunababy-200 ">Lokasi Anda</div>
            @livewire('select-location')
        </div>
        <div class="p-8 mt-4 border border-bunababy-50 rounded">
            <!-- Radios Stacked -->
            <div class="space-y-2">
                <div class="text-sm font-semibold text-bunababy-200 ">Tempat Treatment</div>
                <div class="space-y-4">
                    <label class="flex items-center">
                        <input type="radio" class="w-4 h-4 text-bunababy-200 border border-gray-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" />
                        <div class="ml-4">
                            <span class="font-semibold">Homecare</span>
                            <div class="text-sm">Di rumah sesuai alamat lokasi</div>
                        </div>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" class="w-4 h-4 text-bunababy-200 border border-gray-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50" name="tk-form-elements-radios-stacked" />
                        <div class="ml-4">
                            <span class="font-semibold">Onsite</span>
                            <div class="text-sm">Di Klinik bunababy</div>
                        </div>
                    </label>
                </div>
            </div>
            <!-- END Radios Stacked -->
        </div>
    </div>
    <div class="mt-6 flex-1 md:mt-0">
        <div class="mb-4 font-semibold">Cari Jadwal Bidan untuk Wilayah Cibeunying Kidul</div>
        <div class="space-y-4">
                @livewire('select-midwife', ['midwifeId' => 2])
                @livewire('select-midwife', ['midwifeId' => 1])
        </div>
    </div>
</div>

<x-menubar/>

</x-client-layout>
