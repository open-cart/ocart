<a {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-3 py-2 bg-gray-800 border border-transparent rounded-md text-white tracking-widest hover:bg-gray-900 focus:border-transparent focus:outline-none disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
