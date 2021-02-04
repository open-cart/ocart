@props(['value', 'error' => ''])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm font-semibold py-1'])->merge([
    'class' => $error ? 'text-red-600':'text-gray-700'
]) }}>
    {{ $value ?? $slot }}
</label>
