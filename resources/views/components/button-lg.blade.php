<button {{ $attributes->merge(['class' => 'block w-full py-4 text-center text-white transition duration-150 ease-in-out rounded-full shadow-xl disabled:opacity-25 bg-bunababy-200 shadow-bunababy-100/50']) }}>
    {{ $slot }}
</button>
