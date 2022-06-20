@props(['disabled' => false, 'dark' => true])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border border-gray-300 focus:border-blue-500 focus:ring-0 bg-white text-gray-900
 appearance-none inline-block focus:text-gray-900 rounded py-2 px-3 focus:outline-none ' . ($dark ? '
  dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:focus:text-gray-300
 ' : '')]) !!} rows="4">
</textarea>
