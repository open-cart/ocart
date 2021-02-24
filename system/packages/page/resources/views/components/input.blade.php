@props(['icon' => ''])
<div class="{!! $icon ? 'relative': '' !!}">
    @if($icon)
        <div class="absolute py-2 px-3">
            <i data-feather="{!! $icon !!}"></i>
        </div>
    @endif
    <x-input {{ $attributes->merge(['class' => 'w-full ' . ($icon ? 'pl-10': '')]) }}/>
</div>
