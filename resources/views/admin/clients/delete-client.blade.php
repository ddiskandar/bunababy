<x-action-section>
    <x-slot name="title">Hapus Data Pelanggan</x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Setelah dihapus, semua data akan hilang secara permanen. Pastikan untuk mengunduh data yang mungkin diperlukan.') }}
        </div>
        <div class="mt-4">
            <x-danger-button wire:click="confirmDelete">Hapus Data Pelanggan</x-danger-button>
        </div>

        <x-dialog wire:model="showDialog">
            <form wire:submit.prevent="delete">
                <div class="py-4 mt-2 overflow-y-auto">
                    Yakin data <span class="font-semibold">{{ $user->name }}</span> ini mau dihapus?
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
