@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-3 px-3 font-medium rounded text-bunababy-200 bg-bunababy-50'
            : 'flex items-center space-x-3 px-3 font-medium rounded text-slate-600 hover:text-bunababy-200 transition-all ease-in-out hover:bg-bunababy-50 active:bg-bunababy-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
