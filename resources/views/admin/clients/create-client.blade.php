<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 md:w-1/3">
                <h3 class="mb-2 font-semibold">
                    <span>Buat Data Pelanggan Baru</span>
                </h3>
            </div>
            <div class="md:w-2/3 md:pl-2">
                <form wire:submit.prevent="save" class="space-y-6">
                    <div class="space-y-1">
                        <x-label   for="state.name">Nama</x-label>
                        <x-input wire:model.lazy="state.name" class="w-full" type="text" id="state.name" />
                        <x-input-error for="state.name" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.email">Alamat Email</x-label>
                        <x-input wire:model.lazy="state.email" class="w-full" type="email" id="state.email" />
                        <x-input-error for="state.email" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="state.phone">Nomor WA</x-label>
                        <x-input wire:model.lazy="state.phone" class="w-full" type="text" id="state.phone" />
                        <x-input-error for="state.phone" class="mt-2" />
                    </div>
                    <div class="flex items-center">
                        <div  >
                            <x-button wire:click="save" wire:loading.attr="disabled">Simpan</x-button>
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
