@props(['title', 'required' => '', 'error' => '', 'name' => '', 'errors', 'info' => ''])
<div class="pt-3 lg:flex {!! $errors->first($name) ? 'text-red-600':'' !!}">
    <x-label :error="$errors->first($name)" class="lg:w-64">
        {!! $title !!}
        @if($required)
            <span class="text-red-600">*</span>
        @endif
    </x-label>
    <div class="flex-auto">
        {{ $slot }}
        @if($errors->has($name))
            <span class="py-1 flex items-center text-red-500 font-semibold">
                <i class="" data-feather="info" width="12" height="12" stroke-width="3"></i>
                <span class="text-xs">&nbsp;{!! $errors->first($name) !!}</span>
            </span>
        @else
            @if($info)
                <span class="py-1 flex items-center text-gray-900 font-semibold">
                    <i class="" data-feather="info" width="12" height="12" stroke-width="3"></i>
                    <span class="text-xs">&nbsp;{!! $info !!}</span>
                </span>
            @endif
        @endif
    </div>
    <div class="xl:w-32 2xl:w-64"></div>
</div>
