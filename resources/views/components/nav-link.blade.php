@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-3 px-3 font-medium rounded text-brand-200 bg-brand-50'
            : 'flex items-center space-x-3 px-3 font-medium rounded text-slate-600 hover:text-brand-200 transition-all ease-in-out hover:bg-brand-50 active:bg-brand-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
