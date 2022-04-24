<div>
    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="mb-4 md:flex-none md:w-1/3">
            <h3 class="font-semibold">
                <span>Setting</span>
            </h3>
            <p class="text-sm text-gray-500">
                {{-- Nomor Rekening Pembayaran --}}
            </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 space-y-6 lg:p-6 grow">
            <div class="space-y-1">
                <x-label   for="state.timeout">Timeout</x-label>
                <x-input wire:model.lazy="state.timeout" class="w-full" type="text" id="state.timeout" />
                <x-input-error for="state.timeout" class="mt-2" />
            </div>
            <div class="flex items-center">
                <div  >
                    <x-button wire:click="save">Simpan</x-button>
                </div>
                <x-action-message class="ml-3" on="saved">
                    {{ __('Berhasil disimpan') }}
                </x-action-message>
            </div>
        </div>
        <!-- Card Body: User Profile -->
        </div>
        <!-- Card: User Profile -->
    </div>
    <!-- END User Profile -->
</div>
