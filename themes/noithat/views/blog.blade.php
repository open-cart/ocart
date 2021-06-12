<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom mb-4">
        <ol class="list-reset py-4 border-b border-gray-200 flex text-grey">
            <li class="pr-2"><a href="{!! route('home') !!}" class="no-underline text-blue-600">Home</a></li>
            <li>/</li>
            <li class="px-2 line-clamp-1"><span class="no-underline text-gray-500">Blog</span></li>
        </ol>
    </div>

    <div class="container-custom flex flex-wrap pb-2">
        <div class="lg:w-3/4 w-full md:order-last">
            <div class="flex flex-wrap -mx-2 md:-mx-4">
                @foreach($posts as $post)
                    <div class="w-1/2 xl:w-1/3 p-2 md:p-4 pt-0">
                        <x-theme::card.post :data="$post"/>
                    </div>
                    <div>{!! $posts->links() !!}</div>

                @endforeach
            </div>
        </div>

        @include(Theme::getThemeNamespace('layouts.sidebar-all'))

    </div>

</x-guest-layout>
