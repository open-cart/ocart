@props('color' => 'green-600')
<span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-{!! $color !!} rounded">
    {!! $slot !!}
</span>
