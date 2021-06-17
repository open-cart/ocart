<div x-data="tableActions()">
    @if($edit && Auth::user()->can($edit))
        <x-button-link-icon
                href="{!! route($edit, ['id' => $item->id]) !!}"
                title="{!! __('admin.edit') !!}"
                class="bg-blue-500 hover:bg-blue-600 mr-2">
            <i data-feather="edit" width="18" height="18"></i>
        </x-button-link-icon>
    @endif
    @if($delete && Auth::user()->can($delete))
        <x-button-icon
                x-on:click="destroy('{!! $item->id !!}', '{!! route($delete) !!}')"
                title="{!! __('admin.delete') !!}"
                class="bg-red-500 hover:bg-red-600">
            <i data-feather="trash" width="18" height="18"></i>
        </x-button-icon>
    @endif
</div>