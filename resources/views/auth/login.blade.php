<x-guest-layout>
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center">
        <div>
            <a href="/">
                <img src="/images/logo.svg" alt="Logo">
            </a>
        </div>

        <div class="w-full px-6 py-4 mt-6 mb-6 overflow-hidden bg-white shadow-md sm:max-w-lg sm:rounded-lg">
            <a href="/auth/redirect" class="flex w-full px-4 py-2 mt-4 leading-normal text-center align-middle transition-all duration-300 ease-in border border-solid rounded-md cursor-pointer focus:outline-none focus:text-current text-clrSubText5 bg-clrInverse border-clrBorder01 hover:bg-slate-50 hover:text-clrSubText5" id="button-google">
                <img src="{{ asset('images/google.svg') }}" alt="google" style="margin: auto 0px; width: 24px; height: 24px;">
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

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <input type="hidden" class="g-recaptcha" name="recaptcha_token" id="recaptcha_token">

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
                            {{ __('Lupa password?') }}
                        </a>
                    @endif

                    <x-button class="ml-3">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>

        <div class="w-full px-6 py-4 mb-6 overflow-hidden text-sm text-center bg-white shadow-md sm:max-w-lg sm:rounded-lg">
            Belum punya akun? <a href="/register" class="font-semibold text-brand-200">Daftar Sekarang</a>
        </div>
    </div>

    @push('scripts')
        <script>
            grecaptcha.ready(function () {
                document.getElementById('loginForm').addEventListener("submit", function (event) {
                    event.preventDefault();
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'login' })
                        .then(function (token) {
                            document.getElementById("recaptcha_token").value = token;
                            document.getElementById('loginForm').submit();
                        });
                });
            });
        </script>
    @endpush

</x-guest-layout>
