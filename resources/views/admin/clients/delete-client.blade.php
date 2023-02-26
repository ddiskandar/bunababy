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
                    <button
                        wire:loading.attr="disabled"
                        type="submit"
                        class="flex items-center justify-center w-full h-12 text-center text-white rounded-full shadow-xl bg-bunababy-200 shadow-bunababy-100/50 disabled:opacity-25"
                    >
                        <span wire:loading>
                            <x-loading-spinner />
                        </span>
                        <span wire:loading.remove class="font-semibold">
                            {{ __('Ya, Hapus sekarang') }}
                        </span>
                    </button>
                </div>
            </form>
        </x-dialog>
    </x-slot>
</x-action-section>
