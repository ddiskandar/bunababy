<div>
    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="mb-4 md:flex-none md:w-1/3">
            <h3 class="font-semibold">
                <span>Nomor WA</span>
            </h3>
            <p class="text-sm text-gray-500">
                Owner dan Admin
            </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 space-y-6 lg:p-6 grow">
            <div class="space-y-1">
                <x-label   for="state.wa_admin">WA Admin</x-label>
                <x-input wire:model.lazy="state.wa_admin" class="w-full" type="text" id="state.wa_admin" />
                <x-input-error for="state.wa_admin" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label   for="state.wa_owner">WA Owner</x-label>
                <x-input wire:model.lazy="state.wa_owner" class="w-full" type="text" id="state.wa_owner" />
                <x-input-error for="state.wa_owner" class="mt-2" />
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
