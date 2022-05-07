<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="/images/logo.svg" alt="Logo">
            </a>
        </x-slot>

        <a href="/auth/redirect" class="flex w-full px-4 py-2 mt-4 leading-normal text-center align-middle transition-all duration-300 ease-in border border-solid rounded-md cursor-pointer focus:outline-none focus:text-current text-clrSubText5 bg-clrInverse border-clrBorder01 hover:bg-slate-50 hover:text-clrSubText5" id="button-google">
            <img src="https://assets.kitabisa.cc/images/auth/google.png" alt="google" style="margin: auto 0px; width: 24px; height: 24px;">
            <span class="m-auto">Masuk dengan Google</span>
        </a>

        <h3 class="flex items-center my-8">
            <span aria-hidden="true" class="h-px bg-gray-200 rounded grow"></span>
            <span class="mx-3 text-sm text-slate-400">ATAU</span>
            <span aria-hidden="true" class="h-px bg-gray-200 rounded grow"></span>
        </h3>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block w-full mt-1"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
