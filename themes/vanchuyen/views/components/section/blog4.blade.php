@props(['title' => '', 'title2' => '', 'url' => 'javascript:void(0)', 'url2' => 'javascript:void(0)'])

@php
    $blog = json_decode(theme_options()->getOption('blog4', 0), true);
    if ($blog == 0){
        $posts = get_list_posts(5);
    }else{
        $category = get_post_category($blog);
        $title = $category->name;
        $url = $category->url;
        $posts = get_list_posts_category($blog, 5);
    }

    $blog2 = json_decode(theme_options()->getOption('blog4_2', 0), true);
    if ($blog2 == 0){
        $posts2 = get_list_posts(2);
    }else{
        $category2 = get_post_category($blog2);
        $title2 = $category2->name;
        $url2 = $category2->url;
        $posts2 = get_list_posts_category($blog2, 2);
    }
@endphp
<section class="sec-blog-4 section-custom">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-12">
            <div class="col-span-2">
                @if(!empty($title))
                <div class="sec-blog-header mb-5">
                    <div class="separetor block">
                        <div class="border-divider"></div>
                    </div>
                    <a href="{{ $url }}" class="section-title section-title-main block">
                        {{ $title }}
                    </a>
                </div>
                @endif
                <div class="mb-8">
                    @if($posts->count() >= 1)
                        <div>
                            <x-theme::card.post
                                :data="$posts[0]"
                                type="thumb-bg"
                                classTitle="md:text-3xl md:mb-2 line-clamp-3"
                                :ratio="0.63"
                                sizeImage="large"
                                :deps="true"
                            />
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-8">
                    @foreach($posts as $key => $post)
                        @if($key >= 1)
                            <div>
                                <x-theme::card.post
                                    :data="$post"
                                />
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-span-1">
                @if(!empty($title2))
                <div class="sec-blog-header mb-5">
                    <div class="separetor block">
                        <div class="border-divider"></div>
                    </div>
                    <a href="{{ $url }}" class="section-title section-title-main block">
                        {{ $title2 }}
                    </a>
                </div>
                @endif
                <div>
                    @foreach($posts2 as $key => $post)
                        <div>
                            <x-theme::card.post
                                :data="$post"
                            />
                        </div>
                    @endforeach
                </div>
                @if(!empty(theme_options()->getOption('banner_blog_4', null)))
                <a
                    href="{{ theme_options()->getOption('link_banner_blog_4', 'javascript:void(0)') }}"
                    class="block mb-8"
                >
                    <img
                        data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('banner_blog_4', null) . '?w=400', asset('/images/no-image.jpg')) }}"
                        src="{{ asset('/images/no-image.jpg') }}"
                        alt="banner"
                        class="mx-auto w-full lozad"
                    >
                </a>
                @endif
                @if(!empty(theme_options()->getOption('banner_blog_4_2', null)))
                <a
                    href="{{ theme_options()->getOption('link_banner_blog_4_2', 'javascript:void(0)') }}"
                    class="block mb-8"
                >
                    <img
                        data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('banner_blog_4_2', null) . '?w=400', asset('/images/no-image.jpg')) }}"
                        src="{{ asset('/images/no-image.jpg') }}"
                        alt="banner"
                        class="mx-auto w-full lozad"
                    >
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
