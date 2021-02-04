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
    <div class="pb-12 pt-3">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <div></div>
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
                    <table
                        x-data="listActions"
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
                                    <div
                                        x-data="{isOpen: false, deleteItem: listActions.deleteItem}"
                                        class="flex">
                                        <x-button-link-icon
                                            href="{!! route('plugin_blog::admin.edit', ['id' => $page->id]) !!}"
                                            title="{!! __('admin.edit') !!}"
                                            class="bg-blue-500 hover:bg-blue-600 mr-2">
                                            <i data-feather="edit" width="18" height="18"></i>
                                        </x-button-link-icon>
                                        <x-button-icon
                                            x-on:click="isOpen = !isOpen"
                                            title="{!! __('admin.delete') !!}"
                                            class="bg-red-500 hover:bg-red-600">
                                            <i data-feather="trash" width="18" height="18"></i>
                                        </x-button-icon>
                                        <x-confirm-delete
                                            x-show="isOpen"
                                            @close="isOpen = !isOpen"
                                            @accept="isOpen = !isOpen; deleteItem({!! $page->id !!})"
                                        />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const listActions = {
        deleteItem(id) {
            axios.post('{!! route('plugin_blog::admin.delete') !!}', {id}).then(res => {
                window.location.reload();
            })
        }
    }
</script>
