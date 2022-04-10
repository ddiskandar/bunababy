<div class="space-y-4">
    <!-- User Profile -->
    <div class="md:flex md:space-x-5">
        <!-- User Profile Info -->
        <div class="md:flex-none md:w-1/3 ">
            <h3 class="mb-1 space-x-2 font-semibold">
                <span>Update Password</span>
            </h3>
            <p class="mb-5 text-sm text-gray-500">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </div>
        <!-- END User Profile Info -->

        <!-- Card: User Profile -->
        <div class="flex flex-col overflow-hidden bg-white rounded shadow-sm md:w-2/3">
        <!-- Card Body: User Profile -->
        <div class="w-full p-5 space-y-6 lg:p-6 grow">
            <div class="space-y-1">
                <x-label class="" for="current_password">Password sekarang</x-label>
                <x-input wire:model.defer="current_password" class="w-full" type="password" id="current_password" />
                <x-input-error for="current_password" class="mt-2" />
                @if ($errorCurrentPasswordMessage)
                <p class="text-sm text-red-600">{{ $errorCurrentPasswordMessage }}</p>
                @endif
                <x-input-error for="current_password" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="password">Password baru</x-label>
                <x-input wire:model.defer="password" class="w-full" type="password" id="password" />
                <x-input-error for="password" class="mt-2" />
            </div>
            <div class="space-y-1">
                <x-label class="" for="password_confirmation">Konfirmasi password baru</x-label>
                <x-input wire:model.defer="password_confirmation" class="w-full" type="password" id="password_confirmation" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
            <div class="flex items-center">
                <div class="">
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
