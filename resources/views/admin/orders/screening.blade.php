<x-action-section>
    <x-slot name="title">Screening</x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="save" >
            <div class="space-y-1">
                <x-textarea wire:model.defer="state.screening" class="w-full" type="text" id="state.screening" placeholder="" />
                <x-input-error for="state.screening" class="mt-2" />
            </div>
            <div class="py-4 flex items-center">
                <x-button wire:loading.attr="disabled" wire:target="save">{{ __('Simpan') }}</x-button>
                <x-action-message class="ml-3" on="saved">
                    {{ __('Berhasil disimpan') }}
                </x-action-message>
            </div>
        </form>
    </x-slot>
</x-action-section>
