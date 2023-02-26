<div>
    <form wire:submit.prevent="save">
        <div class="grid grid-cols-6 gap-6 ">
            <!-- Alamat -->
            <div class="col-span-6 lg:col-span-6">
                <x-label for="address" :value="__('Alamat Lengkap')" />
                <x-input wire:model.defer="state.address" id="address" class="block w-full mt-1" type="text" name="address" placeholder="Nama jalan, Nomor Rumah, RT/RW" />
                <x-input-error for="state.address" class="mt-2" />
            </div>

            <!-- Desa -->
            <div class="col-span-6 lg:col-span-2">
                <x-label for="desa" :value="__('Desa / Kelurahan')" />
                <x-input wire:model.defer="state.desa" id="desa" class="block w-full mt-1" type="text" name="desa" />
                <x-input-error for="state.desa" class="mt-2" />
            </div>

            <!-- Kecamatan -->
            <div class="col-span-6 lg:col-span-2">
                <x-label for="kecamatan" :value="__('Kecamatan')" />
                <x-input wire:model.defer="state.kec" disabled id="kecamatan"  class="block w-full mt-1" type="text" name="kecamatan" />
            </div>

            <!-- Kabupaten -->
            <div class="col-span-6 lg:col-span-2">
                <x-label for="kab" :value="__('Kabupaten')" />
                <x-input wire:model.defer="state.kab" disabled id="kab"  class="block w-full mt-1" type="text" name="kab" />
            </div>

            <div class="col-span-6 xl:col-span-2">
                <x-button-on-modal label="Simpan Alamat" />
            </div>
        </div>
    </form>
</div>
