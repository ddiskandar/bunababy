<x-action-section>
    <x-slot name="title">General Information</x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="save" class="space-y-6">
            <div class="space-y-1">
                <x-label for="state.site_name">Site Name</x-label>
                <x-input wire:model.lazy="state.site_name" class="w-full" type="text" id="state.site_name" />
                <x-input-error for="state.site_name" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.site_location">Site Location</x-label>
                <x-input wire:model.lazy="state.site_location" class="w-full" type="text" id="state.site_location" />
                <x-input-error for="state.site_location" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.site_desc">Site Description</x-label>
                <x-input wire:model.lazy="state.site_desc" class="w-full" type="text" id="state.site_desc" />
                <x-input-error for="state.site_desc" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.ig">Instagram</x-label>
                <x-input wire:model.lazy="state.ig" class="w-full" type="text" id="state.ig" />
                <x-input-error for="state.ig" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.phone">Phone</x-label>
                <x-input wire:model.lazy="state.phone" class="w-full" type="text" id="state.phone" />
                <x-input-error for="state.phone" class="mt-2" />
            </div>
            <div class="flex items-center">
                <div>
                    <x-button wire:loading.attr="disabled" wire:target="save">{{ __('Simpan') }}</x-button>
                </div>
                <x-action-message class="ml-3" on="saved">
                    {{ __('Berhasil disimpan') }}
                </x-action-message>
            </div>
        </form>
    </x-slot>
</x-action-section>
