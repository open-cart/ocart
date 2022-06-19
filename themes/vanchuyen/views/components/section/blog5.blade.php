@props(['title' => '', 'title2' => '', 'title3' => '', 'url' => 'javascript:void(0)', 'url2' => 'javascript:void(0)', 'url3' => 'javascript:void(0)'])

<section class="sec-blog-5 section-custom">
    <div class="container-custom">
        @php
            $blog = json_decode(theme_options()->getOption('blog5', 0), true);
            if ($blog == 0){
                $posts = get_list_posts(3);
            }else{
                $category = get_post_category($blog);
                $title = $category->name;
                $url = $category->url;
                $posts = get_list_posts_category($blog, 3);
            }

            $blog2 = json_decode(theme_options()->getOption('blog5_2', 0), true);
            if ($blog2 == 0){
                $posts2 = get_list_posts(3);
            }else{
                $category2 = get_post_category($blog2);
                $title2 = $category2->name;
                $url2 = $category2->url;
                $posts2 = get_list_posts_category($blog2, 3);
            }

            $blog3 = json_decode(theme_options()->getOption('blog5_3', 0), true);
            if ($blog3 == 0){
                $posts3 = get_list_posts(3);
            }else{
                $category3 = get_post_category($blog3);
                $title3 = $category3->name;
                $url3 = $category3->url;
                $posts3 = get_list_posts_category($blog3, 3);
            }
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-12">
            <div>
                @if(!empty($title))
                <div class="sec-blog-header mb-5">
                    <div class="separetor block">
                        <div class="border-divider"></div>
                    </div>
                    <a href="{{ $url }}" class="section-title section-title-sub block">
                        {{ $title }}
                    </a>
                </div>
                @endif
                <div>
                    @foreach($posts as $key => $post)
                        <div class="mb-4 pb-4 @if($key + 1 < $posts->count()) border-b border-dotted border-gray-400 @endif">
                            @if($key < 1)
                                <x-theme::card.post
                                    :data="$post"
                                />
                            @else
                                <x-theme::card.post
                                    :data="$post"
                                    :thumbnail="false"
                                    :categoryType="2"
                                    :transform="false"
                                />
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                @if(!empty($title2))
                <div class="sec-blog-header mb-5">
                    <div class="separetor block">
                        <div class="border-divider"></div>
                    </div>
                    <a href="{{ $url2 }}" class="section-title section-title-sub block">
                        {{ $title2 }}
                    </a>
                </div>
                @endif
                <div>
                    @foreach($posts2 as $key => $post)
                        <div class="mb-4 pb-4 @if($key + 1 < $posts2->count()) border-b border-dotted border-gray-400 @endif">
                            @if($key < 1)
                                <x-theme::card.post
                                    :data="$post"
                                />
                            @else
                                <x-theme::card.post
                                    :data="$post"
                                    :thumbnail="false"
                                    :categoryType="2"
                                    :transform="false"
                                />
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div>
                @if(!empty($title3))
                <div class="sec-blog-header mb-5">
                    <div class="separetor block">
                        <div class="border-divider"></div>
                    </div>
                    <a href="{{ $url3 }}" class="section-title section-title-sub block">
                        {{ $title3 }}
                    </a>
                </div>
                @endif
                <div>
                    @foreach($posts3 as $key => $post)
                        <div class="mb-4 pb-4 @if($key + 1 < $posts3->count()) border-b border-dotted border-gray-400 @endif">
                            @if($key < 1)
                                <x-theme::card.post
                                    :data="$post"
                                />
                            @else
                                <x-theme::card.post
                                    :data="$post"
                                    :thumbnail="false"
                                    :categoryType="2"
                                    :transform="false"
                                />
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
