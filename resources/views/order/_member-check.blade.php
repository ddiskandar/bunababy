<div x-data="{ show : true}">
    <!-- Alternate Alert -->
    <div class="p-4 border border-bunababy-100/70 bg-bunababy-50/70 text-bunababy-400 rounded md:p-5"
        x-show="show"
        x-transition.opacity.duration.300ms
    >
        <h4 class="mb-1 font-semibold">
            Login
        </h4>
        <p class="mb-5 text-sm text-bunababy-400">
            Bila sebelumnya sudah pernah treatment, silahkan untuk login
        </p>
        <div class="space-y-2 sm:flex sm:items-center sm:space-x-2 sm:space-y-0">
            <a href="{{ route('login') }}">
                <x-button>
                    Login sekarang
                </x-button>
            </a>
            <button class="inline-flex items-center justify-center px-3 py-2 space-x-2 text-sm font-semibold leading-5 text-bunababy-200 border border-transparent rounded focus:outline-none"
                x-on:click="
                    show = false;
                    Livewire.emit('newUser');
                "
            >
                Tidak, Ini pertama kali treatment
            </button>
        </div>
    </div>
    <!-- END Alternate Alert -->
</div>
