@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-gray-300 focus:border-blue-500 focus:ring-0 bg-white text-gray-900 appearance-none inline-block focus:text-gray-900 rounded py-2 px-4 focus:outline-none']) !!}>
    {!! $slot !!}
</select>