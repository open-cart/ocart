<x-app-layout>
    <x-slot name="header">
        <ol class="list-reset flex text-grey-dark">
            <li>
                <a href="{{ route('admin:home') }}" class="text-blue font-bold flex items-center">
                    <i data-feather="home" width="16"></i>&nbsp;Home
                </a>
            </li>
            <li><span class="mx-2">/</span></li>
            <li><a href="#" class="text-blue font-bold">Bài viết</a></li>
            <li><span class="mx-2">/</span></li>
            <li>Danh sách trang</li>
        </ol>
    </x-slot>
    <div class="pb-12 pt-3" id="page-container">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <div class="mt-1 w-36 relative">
                                <select class="block appearance-none border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option>Tên a-z</option>
                                    <option>Tên z-a</option>
                                    <option>ID desc</option>
                                    <option>ID asc</option>
                                </select>
                                <div class="absolute flex inset-y-0 items-center px-3 right-0 text-gray-700 bg-purple-300 rounded-r">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <x-button-link-icon
                                href="{!! route('plugin_blog::admin.create') !!}"
                                title="{!! __('admin.add_new') !!}"
                                class="bg-green-500 hover:bg-green-600 mr-2">
                                <i data-feather="plus" width="18" height="18"></i>
                            </x-button-link-icon>
                        </div>
                    </div>
                    <div class="h-3"></div>
                    <div
                        x-data="listActions">
                        <span>{!! do_action('nguyen', 'Phan Trung Nguyen') !!}</span>
                        <span>{!! apply_filters('nguyen', '123', 'abc') !!}</span>
                        <table
                            class="w-full border-collapse border">
                            <thead>
                            <tr>
                                <th class="border text-left px-2 py-2">Tiêu đề</th>
                                <th class="border text-left px-2 py-2">Hình ảnh</th>
                                <th class="border text-left px-2 py-2">URL Tùy chỉnh</th>
                                <th class="border text-left px-2 py-2">{!! __('admin.status') !!}</th>
                                <th class="border text-left px-2 py-2">{!! __('admin.action') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td class="border p-2">
                                        {!! $page->title !!}
                                    </td>
                                    <td class="border p-2">
                                        <img src="{!! $page->image !!}" class="w-14"/>
                                    </td>
                                    <td class="border p-2">
                                        {!! $page->alias !!}
                                    </td>
                                    <td class="border p-2">
                                        @if($page->status == 1)
                                            <x-badge class="bg-green-500">
                                                {!! __('admin.status_on') !!}
                                            </x-badge>
                                        @else
                                            <x-badge class="bg-red-500">
                                                {!! __('admin.status_off') !!}
                                            </x-badge>
                                        @endif
                                    </td>
                                    <td class="border p-2">
                                        <div class="flex">
                                            <x-button-link-icon
                                                href="{!! route('plugin_blog::admin.edit', ['id' => $page->id]) !!}"
                                                title="{!! __('admin.edit') !!}"
                                                class="bg-blue-500 hover:bg-blue-600 mr-2">
                                                <i data-feather="edit" width="18" height="18"></i>
                                            </x-button-link-icon>
                                            <x-button-icon
                                                x-on:click="confirmDelete = !confirmDelete; itemSelected = {!! $page->id !!}"
                                                title="{!! __('admin.delete') !!}"
                                                class="bg-red-500 hover:bg-red-600">
                                                <i data-feather="trash" width="18" height="18"></i>
                                            </x-button-icon>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <x-confirm-delete
                            x-show="confirmDelete"
                            @close="confirmDelete = !confirmDelete;"
                            @accept="confirmDelete = !confirmDelete; deleteItem(itemSelected)"
                        />
                        <div class="pt-3">
                            {{ $pages->links() }}
                            {{ $pages->nguyen() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const listActions = {
        data: {!! json_encode($pages) !!},
        confirmDelete: false,
        itemSelected: null,
        deleteItem(id) {
            axios.post('{!! route('plugin_blog::admin.delete') !!}', {id}).then(res => {
                $.pjax.reload('#body', {});
            })
        }
    }
</script>
