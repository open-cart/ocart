    @props(['title' => '', 'title2' => 'Nổi bật', 'url' => 'javascript:void(0)', 'url2' => 'javascript:void(0)'])

@php
    $blog = json_decode(theme_options()->getOption('blog2', 0), true);
    if ($blog == 0){
        $posts = get_list_posts(7);
    }else{
        $category = get_post_category($blog);
        $title = $category->name;
        $url = $category->url;
        $posts = get_list_posts_category($blog, 5);
    }
    $posts2 = get_list_posts_feature(4);
@endphp
<section class="sec-blog-2 section-custom">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-12">
            <div class="col-span-2 mb-5 md:mb-0">
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
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                    <div>
                        @foreach($posts as $key => $post)
                            @if($key >= 1)
                                <div class="mb-6 pb-6 @if($key + 1 < $posts->count() - 1) border-b border-dotted border-gray-400 @endif">
                                    <x-theme::card.post
                                        :data="$post"
                                        type="thumb-left"
                                        :ratio="0.3"
                                        :contentgrow="2.3"
                                        :categoryType="2"
                                        :thumbRadius="true"
                                    />
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div>
                        @if($posts->count())
                            <div>
                                <x-theme::card.post
                                    :data="$posts[0]"
                                    type="thumb-bg"
                                    :deps="true"
                                    classTitle="md:text-3xl md:mb-2 line-clamp-3"
                                    :ratio="1.55"
                                    sizeImage="large"
                                />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                @if(!empty($title2))
                <div class="sec-blog-header mb-5">
                    <div class="separetor block">
                        <div class="border-divider"></div>
                    </div>
                    <a href="javascript:void(0)" class="section-title section-title-main block">
                        {{ $title2 }}
                    </a>
                </div>
                @endif
                <div>
                    @foreach($posts2 as $key => $post)
                        <div class="relative mb-6 pb-6 @if($key + 1 < $posts2->count()) border-b border-dotted border-gray-400 @endif">
                            <span
                                class="bg-blue-600"
                                style="
                                position: absolute;
                                left: -15px;
                                display: block;
                                -webkit-transition: opacity 0.2s ease;
                                transition: opacity 0.2s ease;
                                color: #fff;
                                font-size: 18px;
                                font-weight: 500;
                                top: -15px;
                                width: 40px;
                                height: 40px;
                                border: 2px solid #fff;
                                border-radius: 50%;
                                text-align: center;
                                box-shadow: 0 10px 20px rgb(78 101 255 / 30%);
                                line-height: 37px;
                                z-index: 9;"
                            >
                                {{ $key + 1 }}
                            </span>
                            <x-theme::card.post
                                :data="$post"
                                type="thumb-left"
                                :ratio="0.3"
                                :contentgrow="2.3"
                                :categoryType="2"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
