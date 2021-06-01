@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'h-14 p-3 bg-indigo-50 w-full rounded-md outline-none']) !!}>
