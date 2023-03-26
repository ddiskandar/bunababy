<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-brand-200 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-brand-100 active:bg-brand-200 focus:outline-none focus:ring-0 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
