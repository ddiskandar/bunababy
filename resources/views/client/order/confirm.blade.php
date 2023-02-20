<div class="mt-8">
    @if (session()->has('treatments'))
        <div class="mb-4 text-sm text-red-600">{{ session('treatments') }}</div>
    @endif

    <div class="py-6">
        <button wire:click="confirm" class="flex items-center justify-center w-full py-4 text-center transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-bunababy-200 text-white shadow-bunababy-100/50"
            wire:loading.attr="disabled"
        >
        <span class="ml-2">Checkout</span>
        </button>
    </div>
</div>
