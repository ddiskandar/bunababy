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

            <div class="py-4 mt-2 overflow-y-auto">
                Yakin data <span class="font-semibold">{{ $user->name }}</span> ini mau dihapus?
            </div>

            <div class="py-4">
                <button
                    wire:click="delete"
                    type="button"
                    class="block w-full py-2 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50"
                >Ya, Hapus Sekarang</button>
            </div>

        </x-dialog>
    </x-slot>
</x-action-section>
