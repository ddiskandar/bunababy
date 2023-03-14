<x-action-section>
    <x-slot name="title">General Settings</x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="save" class="space-y-6">
            <div class="space-y-1">
                <x-label for="state.timeout">Batas Waktu Pembayaran DP (menit)</x-label>
                <x-input wire:model.defer="state.timeout" class="w-full" type="text" id="state.timeout" />
                <x-input-error for="state.timeout" class="mt-2" />
            </div>
            <div class="flex items-center">
                <div>
                    <x-button wire:loading.attr="disabled">{{ __('Simpan') }}</x-button>
                </div>
                <x-action-message class="ml-3" on="saved">
                    {{ __('Berhasil disimpan') }}
                </x-action-message>
            </div>
        </form>
    </x-slot>
</x-action-section>
