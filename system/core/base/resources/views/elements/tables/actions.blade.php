<div x-data="tableActions()">
    @if($edit && Auth::user()->can($edit))
        <x-button-link-icon
                href="{!! route($edit, ['id' => $item->id]) !!}"
                title="{!! __('admin.edit') !!}"
                class="bg-blue-500 hover:bg-blue-600 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </x-button-link-icon>
    @endif
    @if($delete && Auth::user()->can($delete))
        <x-button-icon
                x-on:click="destroy('{!! $item->id !!}', '{!! route($delete) !!}')"
                title="{!! __('admin.delete') !!}"
                class="bg-red-500 hover:bg-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        </x-button-icon>
    @endif
</div>