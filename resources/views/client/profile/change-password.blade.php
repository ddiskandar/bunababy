<div class="relative">
    <div class="sticky top-0 z-20 px-4 py-4 text-white shadow bg-brand-200 shadow-brand-50">
        <div class="flex items-center justify-between max-w-screen-sm mx-auto">
            <a href="{{ route('client.profile') }}">
                <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                </svg>
            </a>
            <h1 class="flex-1 font-semibold md:text-center">Ganti Kata Sandi</h1>
            <button
                wire:click="save"
                >
                Simpan
            </button>
        </div>
    </div>

    <div class="max-w-screen-sm px-4 py-6 mx-auto ">
        <div  >
            <x-label for="current_password" :value="__('Password sekarang')" />
            <x-input wire:model="current_password" id="current_password" class="block w-full mt-1" type="password" name="current_password" />
            <x-input-error for="current_password" class="mt-2" />
            @if ($errorCurrentPasswordMessage)
            <p class="text-sm text-red-600">{{ $errorCurrentPasswordMessage }}</p>
            @endif
        </div>
        <div class="mt-4">
            <x-label for="password" :value="__('Password Baru')" />
            <x-input wire:model="password" id="password" class="block w-full mt-1" type="password" name="password" />
            <x-input-error for="password" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Tulis ulang Password Baru')" />
            <x-input wire:model="password_confirmation" id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </div>
</div>
