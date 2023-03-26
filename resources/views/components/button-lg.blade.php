<button {{ $attributes->merge(['class' => 'py-4 text-center text-brand-200 transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-white shadow-brand-100/50']) }}>
    {{ $slot }}
</button>
