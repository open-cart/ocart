<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom mb-4">
        <ol class="list-reset py-4 border-b border-gray-200 flex text-grey">
            <li class="pr-2"><a href="/" class="no-underline text-red-500">Home</a></li>
            <li>/</li>
            <li class="px-2"><span class="no-underline text-gray-500">{{ $category->name }}</span></li>
        </ol>
    </div>

    <div class="container-custom flex flex-wrap pb-2">
        @include(Theme::getThemeNamespace('layouts.sidebar-all'))

        <div class="lg:w-3/4 w-full">
            <div class="flex flex-wrap -mx-4">
                @foreach($posts as $post)
                    <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4 pt-0">
                        <x-theme::item-post :data="$post"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-guest-layout>
