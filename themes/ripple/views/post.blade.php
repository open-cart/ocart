<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom mb-4">
        <ol class="list-reset py-4 border-b border-gray-200 flex text-grey">
            <li class="pr-2"><a href="{!! route('home') !!}" class="no-underline text-blue-600">Home</a></li>
            <li>/</li>
            @if(count($post->categories)>0)
                <li class="px-2 line-clamp-1"><a href="{!! route(ROUTE_BLOG_POST_CATEGORY_SCREEN_NAME, ['slug' => Arr::get($post->categories->first(), 'slug')]) !!}" class="no-underline text-blue-600">{{ Arr::get($post->categories->first(), 'name') }}</a></li>
                <li>/</li>
            @endif
            <li class="px-2 line-clamp-1"><span class="no-underline text-gray-500">{{ $post->name }}</span></li>
        </ol>
    </div>

    <div class="container-custom flex flex-wrap pb-2">
        <div class="lg:w-3/4 w-full md:order-last">
            <div class="mb-4">
                <h1 class="text-2xl text-blue-600 font-bold">{{ $post->name }}</h1>
            </div>
            @if($post->description)
                <div class="mb-4 p-4 bg-gray-100">
                    {!! $post->description !!}
                </div>
            @endif

            <div class="mb-4">
                {!! $post->content !!}
            </div>
            <div class="text-right pb-4 border-b border-gray-100">
                <em>Nguồn: admin</em>
            </div>
            @if(count($post->categories)>0)
                <div class="py-4 border-b border-gray-100">
                    Chuyên mục:
                    @foreach($post->categories as $category)
                        <a href="{!! route(ROUTE_BLOG_POST_CATEGORY_SCREEN_NAME, ['slug' => $category->slug]) !!}">{{ $category->name }}</a>
                        <span> , </span>
                    @endforeach
                </div>
            @endif
            <div class="py-4 border-b border-gray-100">
                Tag: Tin tức
            </div>
            <div class="py-4 border-b border-gray-100 flex">
                Chia sẻ: <span class="flex ml-3 border-gray-200">
                            <a class="text-white bg-blue-500 px-4 rounded-sm"
                               href="javascript:void(window.open('https://www.facebook.com/sharer.php?u=' + encodeURIComponent(document.location) + '?t=' + encodeURIComponent(document.title),'_blank'))">
                                Facebook
                            </a>
                            <a class="ml-2 text-white bg-green-500 px-4 rounded-sm"
                               href="javascript:void(window.open('https://twitter.com/share?url=' + encodeURIComponent(document.location) + '&amp;text=' + encodeURIComponent(document.title) + '&amp;via=fabienb&amp;hashtags=koandesign','_blank'))">
                                Twitter
                            </a>
                        </span>
            </div>
            <div class="hidden py-4 border-b border-gray-100">
                <ul>
                    <li class="mb-5 border-b border-dotted">
                        <div class="pb-6">
                            <div class="float-left w-16">
                                <img src="https://themezhub.net/resido-live/resido/assets/img/user-1.jpg" alt=""
                                     class="rounded-full m-w-16">
                            </div>
                            <div class="pl-6 flex flex-wrap">
                                <div class="comment-meta">
                                    <div class="comment-left-meta">
                                        <h4 class="font-2xl font-bold">Rosalina Kelian</h4>
                                        <div class="mt-1 text-green-500">19th May 2018</div>
                                    </div>
                                </div>
                                <div class="mt-4 text-gray-500">
                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim laborumab.
                                        perspiciatis unde omnis iste natus error
                                        perspiciatis unde omnis iste natus error.</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mb-5">
                        <div class="pb-6">
                            <div class="float-left w-16">
                                <img src="https://themezhub.net/resido-live/resido/assets/img/user-1.jpg" alt=""
                                     class="rounded-full m-w-16">
                            </div>
                            <div class="pl-6 flex flex-wrap">
                                <div class="comment-meta">
                                    <div class="comment-left-meta">
                                        <h4 class="font-2xl font-bold">Rosalina Kelian</h4>
                                        <div class="mt-1 text-green-500">19th May 2018</div>
                                    </div>
                                </div>
                                <div class="mt-4 text-gray-500">
                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim laborumab.
                                        perspiciatis unde omnis iste natus error
                                        perspiciatis unde omnis iste natus error.</p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div>
                    <form>
                        <textarea class="p-3 bg-indigo-50 w-full rounded-md outline-none"
                                  placeholder="Viết bình luận..." rows="5"></textarea>
                        <div class="my-2">
                            <button class="flex text-white bg-green-500 border-0 py-4 px-6 focus:outline-none hover:bg-green-700 rounded"
                                    type="submit">Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="fb-comments" data-href="{!! route(ROUTE_BLOG_POST_SCREEN_NAME, ['slug' => $post->slug]) !!}"
                 data-width="100%" data-numposts="5"></div>

            @if(count($post->categories)>0)
                <div class="py-4">
                    <div>Bài liên quan</div>
                    <div class="flex flex-wrap -mx-2">
                        @foreach(get_list_posts_relate(Arr::get($post->categories->first(), 'id'), 6) as $post)
                            <div class="w-1/2 xl:w-1/3 p-2">
                                <x-theme::card.post :data="$post"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        @include(Theme::getThemeNamespace('layouts.sidebar-all'))

    </div>

</x-guest-layout>
