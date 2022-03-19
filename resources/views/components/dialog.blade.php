@props(['id', 'maxWidth'])

@php
$id = $id ?? md5($attributes->wire('model'));

@endphp

<div
x-data="{
    show: @entangle($attributes->wire('model')).defer,
    focusables() {
        // All focusable element types...
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'

        return [...$el.querySelectorAll(selector)]
            // All non-disabled elements...
            .filter(el => ! el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
}"
x-init="$watch('show', value => {
    if (value) {
        document.body.classList.add('overflow-y-hidden');
        {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
    } else {
        document.body.classList.remove('overflow-y-hidden');
    }
})"
x-on:close.stop="show = false"
x-on:keydown.escape.window="show = false"
x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
x-show="show"
id="{{ $id }}"
x-trap.noscroll="show"
class="fixed inset-0 overflow-y-auto z-90 " aria-labelledby="modal-title" role="dialog" aria-modal="true"
style="display: none !important;"
>
    <div
        x-show = "show"
        class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            tabindex="-1"
            role="dialog"
            aria-labelledby="tk-modal-simple"
            x-bind:aria-hidden="!show"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true">
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div
            x-show="show"
            x-trap.noscroll="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative inline-block w-full text-left align-bottom transition-all transform sm:mb-8 sm:align-middle sm:max-w-lg sm:w-full"
        >
            <button
                x-on:click="show = false"
                class="absolute z-30 p-2 bg-white rounded-full -top-12 right-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 rotate-45 stroke-bunababy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>

            <div class="px-4 pt-5 pb-4 overflow-hidden bg-white rounded-lg shadow-xl sm:p-6 sm:pb-4">

                {{ $slot }}

            </div>
        </div>
    </div>
</div>
