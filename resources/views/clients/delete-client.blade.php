<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 md:w-1/3">
                <h3 class="font-semibold">
                    <span>Hapus Data Pelanggan</span>
                </h3>
            </div>
            <div class="space-y-6 md:w-2/3 md:pl-2">
                <div class="max-w-xl text-sm text-gray-600">
                    {{ __('Setelah dihapus, semua data akan hilang secara permanen. Pastikan untuk mengunduh data yang mungkin diperlukan.') }}
                </div>
                <div class="flex items-center">
                    <div  >
                        <x-danger-button wire:click="confirmDelete">Hapus Data Pelanggan</x-danger-button>
                    </div>
                </div>
            </div>
        </div>
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
</div>
