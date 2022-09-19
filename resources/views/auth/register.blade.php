<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="/images/logo.svg" alt="Logo">
            </a>
        </x-slot>

        <a href="/auth/redirect" class="flex w-full px-4 py-2 mt-4 leading-normal text-center align-middle transition-all duration-300 ease-in border border-solid rounded-md cursor-pointer focus:outline-none focus:text-current text-clrSubText5 bg-clrInverse border-clrBorder01 hover:bg-slate-50 hover:text-clrSubText5" id="button-google">
            <img src="{{ asset('images/google.svg') }}" alt="google" style="margin: auto 0px; width: 24px; height: 24px;">
            <span class="m-auto">Daftar dengan Google</span>
        </a>

        <h3 class="flex items-center my-8">
            <span aria-hidden="true" class="h-px bg-gray-200 rounded grow"></span>
            <span class="mx-3 text-sm text-slate-400">ATAU</span>
            <span aria-hidden="true" class="h-px bg-gray-200 rounded grow"></span>
        </h3>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nama lengkap')" />
                <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Nomor WA')" />
                <x-input id="phone" class="block w-full mt-1" type="text" name="phone" :value="old('phone')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block w-full mt-1"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" class="block w-full mt-1"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Sudah Terdaftar?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
