<div>
    <form wire:submit.prevent="save">
    <div class="grid grid-cols-6 gap-6 pt-6 mt-6 border-t border-bunababy-50">
        <!-- Alamat -->
        <div class="col-span-6 lg:col-span-4">
            <x-label for="" :value="__('Alamat Kampung / Jalan')" />
            <x-input wire:model.defer="state.address" id="address" class="block w-full mt-1" type="text" name="address" />
            <x-input-error for="state.address" class="mt-2" />
        </div>

        <!-- Rt -->
        <div class="col-span-6 lg:col-span-1">
            <x-label for="rt" :value="__('RT')" />
            <x-input wire:model.defer="state.rt" id="rt" class="block w-full mt-1" type="number" name="rt" />
            <x-input-error for="state.rt" class="mt-2" />
        </div>

        <!-- Rw -->
        <div class="col-span-6 lg:col-span-1">
            <x-label for="rw" :value="__('RW')" />
            <x-input wire:model.defer="state.rw" id="rw" class="block w-full mt-1" type="number" name="rw" />
            <x-input-error for="state.rw" class="mt-2" />
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
            <x-button
                wire:loading.attr="disabled"
            >
                Simpan Alamat
            </x-button>
        </div>
    </div>
    </form>
</div>
