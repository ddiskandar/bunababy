<x-action-section>
    <x-slot name="title">Hapus Reservasi</x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Setelah dihapus, semua data akan hilang secara permanen. Pastikan untuk mengunduh data yang mungkin diperlukan.') }}
        </div>
        <x-danger-button class="mt-4" wire:click="confirmDelete">Hapus Data Reservasi</x-danger-button>

        <x-dialog wire:model="showDialog">
            <form wire:submit.prevent="delete">
                <div class="py-4 overflow-y-auto">
                    <div>
                        Yakin mau dihapus?
                    </div>
                    <div class="mt-2 space-y-1 ">
                        <x-label for="note">Alasan</x-label>
                        <x-textarea wire:model.defer="note" class="w-full" type="text" id="note" />
                        <x-input-error for="note" class="mt-2" />
                    </div>

                </div>

                <div class="py-4">
                    <x-button-on-modal
                        target="delete"
                        label="Ya, Hapus sekarang"
                    />
                </div>
            </form>

        </x-dialog>
    </x-slot>
</x-action-section>
