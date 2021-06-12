@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'p-3 bg-indigo-50 w-full rounded-md outline-none']) !!} rows="3"></textarea>