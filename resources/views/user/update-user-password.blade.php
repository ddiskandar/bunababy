<div class="flex flex-col overflow-hidden bg-white rounded shadow-sm">
    <div class="w-full p-5 lg:p-6 grow">
        <div class="md:flex">
            <div class="mb-5 md:w-1/3">
                <h3 class="mb-1 space-x-2 font-semibold">
                    <span>Update Password</span>
                </h3>
                <p class="mb-5 text-sm text-gray-500">
                    Ensure your account is using a long, random password to stay secure.
                </p>
            </div>
            <div class="md:w-2/3 md:pl-2">
                <form wire:submit.prevent="save" class="space-y-6">
                    <div class="space-y-1">
                        <x-label   for="current_password">Password sekarang</x-label>
                        <x-input wire:model.defer="current_password" class="w-full" type="password" id="current_password" />
                        <x-input-error for="current_password" class="mt-2" />
                        @if ($errorCurrentPasswordMessage)
                        <p class="text-sm text-red-600">{{ $errorCurrentPasswordMessage }}</p>
                        @endif
                    </div>
                    <div class="space-y-1">
                        <x-label   for="password">Password baru</x-label>
                        <x-input wire:model.defer="password" class="w-full" type="password" id="password" />
                        <x-input-error for="password" class="mt-2" />
                    </div>
                    <div class="space-y-1">
                        <x-label   for="password_confirmation">Konfirmasi password baru</x-label>
                        <x-input wire:model.defer="password_confirmation" class="w-full" type="password" id="password_confirmation" />
                        <x-input-error for="password_confirmation" class="mt-2" />
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
