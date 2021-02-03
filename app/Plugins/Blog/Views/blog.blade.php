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
                                <x-badge class="bg-green-500">Bật</x-badge>
                                <x-badge class="bg-red-500">Tắt</x-badge>
                            </td>
                            <td class="border p-2">858</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
