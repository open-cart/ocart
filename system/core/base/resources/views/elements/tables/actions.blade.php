<div x-data="tableActions()">
    <x-button-link-icon
        href="{!! route($edit, ['id' => $item->id]) !!}"
        title="{!! __('admin.edit') !!}"
        class="bg-blue-500 hover:bg-blue-600 mr-2">
        <i data-feather="edit" width="18" height="18"></i>
    </x-button-link-icon>
    <x-button-icon
        x-on:click="destroy('{!! $item->id !!}')"
        title="{!! __('admin.delete') !!}"
        class="bg-red-500 hover:bg-red-600">
        <i data-feather="trash" width="18" height="18"></i>
    </x-button-icon>
</div>
@once
@push('scripts')
    <script>
        function tableActions() {
            return {
                destroy(id) {
                    confirmDelete.show(() => {
                        axios.delete('{!! route($delete) !!}', {data: {id}})
                            .then(res => {
                                $.pjax.reload('#body', {});
                            })
                    })
                },
            }
        }
    </script>
@endpush
@endonce
