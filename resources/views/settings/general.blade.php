<div class="mb-4">
    <!-- Billing Information -->
    <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
        <div class="w-full p-5 lg:p-6 grow">
            <div class="md:flex">
                <div class="mb-5 border-b md:flex-none md:w-1/3 md:border-0 md:mb-0">
                    <h3 class="flex items-center mb-2 space-x-2 font-semibold">
                        <span>General Information</span>
                    </h3>
                    <p class="mb-5 text-sm text-gray-500">
                        Informasi berikut akan tampil pada invoice.
                    </p>
                </div>
                <div class="md:w-2/3 md:pl-24">
                    <form class="space-y-6" onsubmit="return false;">
                        <div class="space-y-1">
                            <x-label class="" for="state.site_name">Site Name</x-label>
                            <x-input wire:model.lazy="state.site_name" class="w-full" type="text" id="state.site_name" />
                            <x-input-error for="state.site_name" class="mt-2" />
                        </div>
                        <div class="space-y-1">
                            <x-label class="" for="state.site_location">Site Location</x-label>
                            <x-input wire:model.lazy="state.site_location" class="w-full" type="text" id="state.site_location" />
                            <x-input-error for="state.site_location" class="mt-2" />
                        </div>
                        <div class="space-y-1">
                            <x-label class="" for="state.site_desc">Site Description</x-label>
                            <x-input wire:model.lazy="state.site_desc" class="w-full" type="text" id="state.site_desc" />
                            <x-input-error for="state.site_desc" class="mt-2" />
                        </div>
                        <div class="space-y-1">
                            <x-label class="" for="state.ig">Instagram</x-label>
                            <x-input wire:model.lazy="state.ig" class="w-full" type="text" id="state.ig" />
                            <x-input-error for="state.ig" class="mt-2" />
                        </div>
                        <div class="flex items-center">
                            <div class="">
                                <x-button wire:click="save">Simpan</x-button>
                            </div>
                            <x-action-message class="ml-3" on="saved">
                                {{ __('Berhasil disimpan') }}
                            </x-action-message>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Billing Information -->
</div>
