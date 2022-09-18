<div class="mt-8">
    @if (session()->has('treatments'))
        <div class="mb-4 text-sm text-red-600">{{ session('treatments') }}</div>
    @endif

    <div class="py-6">
        <button class="flex items-center justify-center w-full py-4 text-center transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-bunababy-200 text-white shadow-bunababy-100/50"
            wire:loading.attr="disabled"
        >
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <polyline points="7 7 12 12 7 17"></polyline>
            <polyline points="13 7 18 12 13 17"></polyline>
        </svg>
        <span class="ml-2">Checkout</span>
        </button>
    </div>
</div>
