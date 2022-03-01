@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-bunababy-50 focus:border-none focus:ring focus:ring-bunababy-100 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-slate-100 disabled:opacity-75']) !!}>
