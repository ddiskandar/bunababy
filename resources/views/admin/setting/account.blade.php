<x-action-section>
    <x-slot name="title">Account</x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="save" class="space-y-6">
            <div class="space-y-1">
                <x-label for="state.account">Bank dan Nomor Rekening</x-label>
                <x-input wire:model="state.account" class="w-full" type="text" id="state.account" />
                <x-input-error for="state.account" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label for="state.account_name">Nama pemilik</x-label>
                <x-input wire:model="state.account_name" class="w-full" type="text" id="state.account_name" />
                <x-input-error for="state.account_name" class="mt-2" />
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
