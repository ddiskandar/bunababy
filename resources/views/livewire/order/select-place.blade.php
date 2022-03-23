<div class="py-2 space-y-4">
    <label class="flex items-center">
        <input
            wire:model="place"
            value="1"
            type="radio"
            class="w-4 h-4 border border-gray-200 text-bunababy-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50"
            name="tk-form-elements-radios-stacked"
        />
        <div class="ml-4">
            <span class="font-semibold">Homecare</span>
            <div class="text-sm">Di rumah sesuai alamat lokasi</div>
        </div>
    </label>
    <label class="flex items-center">
        <input
            wire:model="place"
            value="2"
            type="radio"
            class="w-4 h-4 border border-gray-200 text-bunababy-200 focus:border-bunababy-200 focus:ring focus:ring-bunababy-200 focus:ring-opacity-50"
            name="tk-form-elements-radios-stacked"
        />
        <div class="ml-4">
            <span class="font-semibold">Onsite</span>
            <div class="text-sm">Di Klinik bunababy</div>
        </div>
    </label>
</div>
