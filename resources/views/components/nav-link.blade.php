@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-3 px-3 font-medium rounded text-gray-700 bg-gray-100'
            : 'flex items-center space-x-3 px-3 font-medium rounded text-gray-600 hover:text-gray-700 hover:bg-gray-100 active:bg-gray-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
