<x-action-section>
    <x-slot name="title">Edit Tempat</x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="save" class="space-y-6">
            <div class="space-y-1">
                <x-label for="state.name">Nama Tempat</x-label>
                <x-input wire:model.defer="state.name" class="w-full" type="text" id="state.name" />
                <x-input-error for="state.name" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.desc">Deskripsi Alamat</x-label>
                <x-input wire:model.defer="state.desc" class="w-full" type="text" id="state.desc" />
                <x-input-error for="state.desc" class="mt-2" />
            </div>
            <div class="space-y-1">
                <div class="inline-flex items-center ml-2">
                    <div class="flex items-center h-5 ">
                        <input type="checkbox" wire:model.defer="state.active" name="state.active" class="w-12 transition-all duration-150 ease-out rounded-full cursor-pointer form-switch h-7 text-brand-200 focus:ring focus:ring-brand-200 focus:ring-opacity-50">
                    </div>
                    <div class="ml-2 ">
                        <x-label for="state.active">Aktif</x-label>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <div>
                    <x-button wire:loading.attr="disabled">Simpan</x-button>
                </div>
                <x-action-message class="ml-3" on="saved">
                    {{ __('Berhasil disimpan') }}
                </x-action-message>
            </div>
        </form>
    </x-slot>
</x-action-section>
