@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-brand-50 focus:border-brand-100 focus:ring-0 focus:ring-brand-100 focus:ring-opacity-50 rounded-md disabled:bg-slate-100 disabled:opacity-75']) !!}>
