<div>
    <div class="sticky flex items-center justify-between px-4 py-4 bg-bunababy-200 text-white shadow md:px-6 shadow-bunababy-50">
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

    <div class="max-w-xl px-4 py-6 mx-auto ">
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

        <!-- Banner (bottom bubble) -->
        <div
            x-data="{ show: @entangle('successMessage') }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-8"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-8"
            style="display: none !important"
            class="fixed inset-x-0 bottom-0 right-0 flex items-center justify-between px-8 py-2 mx-auto mb-24 rounded-full shadow-lg w-80 z-60 bg-bunababy-200">
            <div class="inline-flex items-center text-sm text-pink-100">
                <p>
                    Password berhasil diperbaharui
                </p>
            </div>
            <div class="flex items-center ml-2">
                <button
                    wire:click="$set('successMessage', false)"
                    type="button" class="inline-flex items-center justify-center p-1 text-white rounded opacity-75 focus:outline-none hover:opacity-100 active:opacity-75">
                    <svg class="inline-block w-4 h-4 hi-outline hi-x" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
        <!-- END Banner (bottom bubble) -->

</div>
