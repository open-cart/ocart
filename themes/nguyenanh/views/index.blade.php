<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @php
        $banner = get_banner();
    @endphp
    @if(is_active_plugin('blog'))
        <section class="sec-post antialiased bg-gray-100 font-sans py-16">
            <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
            </div>
            <div class="container-custom">
                @php
                    $posts = get_list_posts()
                @endphp
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-9 space-y-4">
                        <div>
                            {!! $posts->links() !!}
                        </div>
                        @foreach($posts as $post)
                            <a href="{!! route(ROUTE_BLOG_POST_SCREEN_NAME, ['slug' => $post->slug]) !!}"
                               class="w-full lg:flex">
                                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                                     style="background-image: url('{!! TnMedia::url($data->image ?? asset('/images/no-image.jpg')) !!}')" title="Mountain">
                                </div>
                                <div class="w-full bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                                    <div class="mb-8">
                                        <div class="text-gray-900 font-bold text-xl mb-2">
                                            {!! $post->name !!}
                                        </div>
                                        <p class="text-sm text-gray-600 flex items-center mb-2">
                                            <x-theme::icons.user-circle class="text-gray-500 w-4 h-4 mr-1"/>
                                            <i class="fa fa-user"></i>
                                            {!! $post->auth->name !!}
                                        </p>
                                        <p class="text-gray-700 text-base">
                                            {!! Str::limit($post->description, 150) !!}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        {!! $posts->links() !!}
                    </div>
                    <div class="col-span-3 space-y-4">
                        @if(is_active_plugin('blog'))
                            <div class="pt-4 mb-4 bg-white p-3 rounded">
                                <div class="mb-2 font-bold">Danh mục bài viết</div>
                                <ul>
                                    @foreach(get_blog_categories() as $category)
                                        <li>
                                            <a href="/post-category/{{ $category->slug }}"
                                               data-body="category-container"
                                               class="text-sm font-semibold block text-gray-500 hover:text-blue-600">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </section>
    @endif
</x-guest-layout>
