@props(['color' => 'bg-indigo-500 hover:bg-indigo-600'])

<button {{ $attributes->merge(['type' => 'submit', 'class' => '
inline-flex items-center px-4 py-2 '.$color.' border border-transparent rounded-md text-white tracking-widest
focus:border-transparent focus:outline-none
  disabled:opacity-75 transition ease-in-out duration-150
  ']) }}>
    {{ $slot }}
</button>
