@if($active == 1)
    <x-badge class="bg-green-500">
        {!! __('admin.status_on') !!}
    </x-badge>
@else
    <x-badge class="bg-red-500">
        {!! __('admin.status_off') !!}
    </x-badge>
@endif
