<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 border-b md:flex-none md:w-1/3 md:border-0 md:mb-0">
                <h3 class="flex items-center justify-center mb-1 space-x-2 font-semibold md:justify-start">
                    <span>Bidan</span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Buat data bidan baru
                </p>
            </div>
            <div class="md:w-2/3 md:pl-24">
                <form wire:submit.prevent="save" class="space-y-6">
                    <div class="space-y-1">
                        <x-label   for="state.name">Nama bidan</x-label>
                        <x-input wire:model.defer="state.name" class="w-full" type="text" id="state.name" />
                        <x-input-error for="state.name" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.email">Alamat Email</x-label>
                        <x-input wire:model.defer="state.email" class="w-full" type="email" id="state.email" />
                        <x-input-error for="state.email" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.phone">Nomor WA</x-label>
                        <x-input wire:model.defer="state.phone" class="w-full" type="text" id="state.phone" />
                        <x-input-error for="state.phone" class="mt-2" />
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
            </div>
        </div>
    </div>
</div>
