<x-app-layout>
    <x-slot name="header">
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Page') }}--}}
{{--        </h2>--}}
        <ol class="list-reset flex text-grey-dark">
            <li>
                <a href="{{ route('dashboard.index') }}" class="text-blue font-bold flex items-center">
                    <i data-feather="home" width="16"></i>&nbsp;Home
                </a>
            </li>
            <li><span class="mx-2">/</span></li>
            <li><a href="#" class="text-blue font-bold">Phần mở rộng</a></li>
            <li><span class="mx-2">/</span></li>
            <li>Danh sách trang</li>
        </ol>
    </x-slot>
    <div class="pb-12 pt-3">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div x-data="{tab: 1}" class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <nav>
                            <ul class="flex">
                                <li x-on:click="tab = 1"
                                    :class="{'border-b-2 border-indigo-600': tab===1}"
                                    class="py-2 px-4 cursor-pointer">
                                    <span>Đã lưu trên máy</span>
                                </li>
                                <li x-on:click="tab = 2"
                                    :class="{'border-b-2 border-indigo-600': tab===2}"
                                    class="py-2 px-4 cursor-pointer">
                                    <span>Cửa hàng</span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="h-3"></div>
                    <div x-show="tab === 1">
                        <div class="flex justify-between">
                            <div>
                                <x-button
                                    title="Làm mới"
                                    class="bg-blue-500 hover:bg-blue-600">
                                    <i data-feather="rotate-ccw"></i>
                                </x-button>
                                <x-input/>
                            </div>
                            <div>
                                <x-button
                                    title="Thêm mới"
                                    class="bg-green-500 hover:bg-green-600">
                                    <i data-feather="rotate-ccw"></i>
                                </x-button>
                            </div>
                        </div>
                        <div class="h-3"></div>
                        <table class="w-full border-collapse border">
                            <thead>
                            <tr>
                                <th class="border text-left px-2 py-2">Hình ảnh</th>
                                <th class="border text-left px-2 py-2">Tên chức năng</th>
                                <th class="border text-left px-2 py-2">Phiên bản</th>
                                <th class="border text-left px-2 py-2">Tác giả</th>
                                <th class="border text-left px-2 py-2">Liên kết</th>
                                <th class="border text-left px-2 py-2">Thứ tự</th>
                                <th class="border text-left px-2 py-2">Hành động</th>
                            </tr>
                            </thead>
                            <tbody x-data="pluginActions()">
                            @foreach($plugins as $key => $plugin)
                                <tr>
                                    <td class="border p-2">
{{--                                        <img src="/images/no-image.jpg" class="w-14"/>--}}
                                        <img src="{!! $plugin->image !!}" class="w-14"/>
                                    </td>
                                    <td class="border p-2">{!! $plugin->name !!}</td>
                                    <td class="border p-2">{!! $plugin->version !!}</td>
                                    <td class="border p-2">
                                        {!! $plugin->auth !!}
                                    </td>
                                    <td class="border p-2">
                                        <a href="{!! $plugin->link !!}" target="_blank">Link</a>
                                    </td>
                                    <td class="border p-2">0</td>
                                    <td class="border p-2">
                                        @if(true)
                                            <div class="flex">
                                                @if($plugin->status === 1)
                                                    <a href="javascript:void(0)"
                                                       title="{!! __('admin.plugins.action_disable_title') !!}"
                                                       x-on:click="disable('{{ $key }}')">
                                                        <div class="p-1">
                                                            <i data-feather="power" class="text-red-600"></i>
                                                        </div>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                       title="{!! __('admin.plugins.action_enable_title') !!}"
                                                       x-on:click="enable('{{ $key }}')">
                                                       <div class="p-1">
                                                           <i data-feather="send" class="text-indigo-600"></i>
                                                       </div>
                                                    </a>
                                                @endif
                                                @if($plugin->config)
                                                    <a href="#"
                                                       title="{!! __('admin.plugins.action_settings_title') !!}"
                                                    >
                                                        <div class="p-1">
                                                            <i data-feather="settings"></i>
                                                        </div>
                                                    </a>
                                                @endif
                                                <div x-data="confirmDelete1()">
                                                    <a href="#"
                                                       title="{!! __('admin.plugins.action_uninstall_title') !!}"
                                                       x-on:click="trash('{!! $key !!}')"
                                                    >
                                                        <div class="p-1">
                                                            <i data-feather="trash" class="text-red-600"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="h-4"></div>
                    </div>
                    <div x-show="tab === 2">
                        <div class="flex justify-between">
                            <div class="w-1/2">
                                <x-input type="text" class="w-full" placeholder="Tìm kiếm"/>
                            </div>
                            <div><span>...</span></div>
                        </div>
                        <div class="h-3"></div>
                        <table class="w-full border-collapse border">
                            <thead>
                            <tr>
                                <th class="border text-left px-2 py-2">Tiêu đề</th>
                                <th class="border text-left px-2 py-2">Hình ảnh</th>
                                <th class="border text-left px-2 py-2">URL Tùy chỉnh</th>
                                <th class="border text-left px-2 py-2">Trạng thái</th>
                                <th class="border text-left px-2 py-2">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="border p-2">
                                    <input type="checkbox" class="appearance-none checked:bg-green-600 focus:bg-green-600 hover:bg-green-600 checked:border-transparent">
                                    Intro to CSS</td>
                                <td class="border p-2">Adam</td>
                                <td class="border p-2">858</td>
                                <td class="border p-2">
                                    <strong class="px-2 bg-green-500 text-white rounded">Bật</strong>
                                    <strong class="px-2 bg-red-500 text-white rounded">Tắt</strong>
                                </td>
                                <td class="border p-2">858</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="h-4"></div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing
                                    <span class="font-medium">1</span>
                                    to
                                    <span class="font-medium">10</span>
                                    of
                                    <span class="font-medium">97</span>
                                    results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <!-- Heroicon name: chevron-left -->
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        1
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        2
                                    </a>
                                    <a href="#" class="hidden md:inline-flex relative items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        3
                                    </a>
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
          ...
        </span>
                                    <a href="#" class="hidden md:inline-flex relative items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        8
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        9
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        10
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <!-- Heroicon name: chevron-right -->
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function pluginActions() {
            return {
                enable(key) {
                    axios.post('{!! route('plugins.change.status') !!}', {
                        key
                    }).then((res) => {
                        toast.success('Your work has been saved');
                    }).catch(e => {
                        toast.error(e.message)
                    }).finally(() => {
                        // $.pjax.reload('#body', {});
                        window.location.reload();
                    })
                },
                disable(key) {
                    axios.post('{!! route('plugins.change.status') !!}', {
                        key
                    }).then((res) => {
                        toast.success('Your work has been saved');
                    }).catch(e => {
                        toast.error(e.message)
                    }).finally(() => {
                        // $.pjax.reload('#body', {});
                        window.location.reload();
                    })
                },
                uninstall(key) {
                    return axios.post('{!! route('admin_plugin::uninstall') !!}', {
                        key
                    }).then(() => {
                        window.location.reload();
                    })
                }
            }
        }

        function confirmDelete1() {
            return {
                trash(key) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            pluginActions().enable(key);
                        }
                    })
                }
            }
        }
    </script>
</x-app-layout>
