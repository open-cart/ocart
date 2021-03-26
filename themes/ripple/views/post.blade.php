<x-guest-layout>
    <div class="container-custom mb-4">
        <ol class="list-reset py-4 border-b border-gray-200 flex text-grey">
            <li class="pr-2"><a href="/" class="no-underline text-red-500">Home</a></li>
            <li>/</li>
            <li class="px-2"><span class="no-underline text-gray-500">{{ $post->name }}</span></li>
        </ol>
    </div>

    <div class="container-custom flex flex-wrap pb-2">
        @include(Theme::getThemeNamespace('layouts.sidebar-all'))

        <div class="lg:w-3/4 w-full">
            <div class="mb-4">
                <h1 class="text-2xl text-red-500 font-bold">{{ $post->name }}</h1>
            </div>
            <div class="mb-4 p-4 bg-gray-100">
                {{ $post->description }}
            </div>
            <div class="mb-4">
                {{ $post->content }}
            </div>
            <div class="text-right pb-4 border-b border-gray-100">
                <em>Nguồn: admin</em>
            </div>
            <div class="py-4 border-b border-gray-100">
                Chuyên mục: Tin tức
            </div>
            <div class="py-4 border-b border-gray-100">
                Tag: Tin tức
            </div>
            <div class="py-4 border-b border-gray-100">
                Chia sẻ
            </div>
            <div class="py-4">Comment</div>
            <div class="py-4">Bài liên quan</div>
        </div>
    </div>

</x-guest-layout>
