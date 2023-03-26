<div
    x-data="{ show: @entangle($attributes->wire('model')).defer }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-x-8"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform translate-x-8"
    style="display: none !important"
    class="fixed inset-x-0 bottom-0 right-0 flex items-center justify-between px-8 py-2 mx-auto mb-8 rounded-full shadow-lg w-72 z-60 bg-brand-200"
>
    <div class="inline-flex items-center text-sm text-pink-100">
        <p>
            {{ $slot }}
        </p>
    </div>
    <div class="flex items-center ml-2">
        <button
            x-on:click="show = false"
            type="button"
            class="inline-flex items-center justify-center p-1 text-white rounded opacity-75 focus:outline-none hover:opacity-100 active:opacity-75"
            >
                <svg class="inline-block w-4 h-4 hi-outline hi-x" stroke="currentColor" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
</div>
