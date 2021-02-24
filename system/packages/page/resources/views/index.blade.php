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
</x-app-layout>
