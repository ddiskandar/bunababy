<div class="space-y-4">
    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="text-center md:flex-none md:w-1/3 md:text-left">
        <h3 class="flex items-center justify-center mb-1 space-x-2 font-semibold md:justify-start">
            <span>Bidan</span>
        </h3>
        <p class="mb-5 text-sm text-gray-500">
            Buat data bidan baru
        </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 lg:p-6 grow space-y-6">
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
            <div class="space-y-1">
                <div class="inline-flex items-center ml-2">
                    <div class="flex items-center h-5 ">
                        <input wire:model.defer="state.active" id="active" name="active" type="checkbox" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    </div>
                    <div class="ml-2 ">
                        <x-label   for="state.active">Aktif</x-label>
                    </div>
                </div>
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
