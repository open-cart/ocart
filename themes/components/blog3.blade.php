@props(['title' => '', 'url' => 'javascript:void(0)'])

@php
    $blog = json_decode(theme_options()->getOption('blog3', 0), true);
    if ($blog == 0){
        $posts = get_list_posts(7);
    }else{
        $category = get_post_category($blog);
        $title = $category->name;
        $url = $category->url;
        $posts = get_list_posts_category($blog, 7);
        $post2 = $posts->first();
    }
@endphp
<section class="sec-blog-3 section-custom bg-gray-900">
    <div class="container-custom">
        @if($title)
        <div class="sec-blog-header mb-5">
            <div class="separetor block">
                <div class="border-divider"></div>
            </div>
            <a href="{{ $url }}" class="section-title section-title-main text-white block">
                {{ $title }}
            </a>
        </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-12">
            <div class="col-span-1">
                <div class="blog-3-tab">
                    @foreach($posts as $key => $post)
                        <div class="mb-6 pb-6 pr-2">
                            <x-theme::card.post
                                :data="$post"
                                type="thumb-left"
                                :ratio="0.1"
                                :contentgrow="1.3"
                                :categoryType="2"
                                :dark="true"
                                :video="true"
                                :transform="false"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-span-2">
                <div>
                    <x-theme::card.post
                        type="thumb-bottom"
                        :data="$post2"
                        classTitle="md:text-4xl md:mt-2"
                        :ratio="0.553"
                        :categoryType="2"
                        :dark="true"
                        :postMeta="false"
                        :deps="false"
                        :video="true"
                        sizeImage="large"
                    />
                </div>
            </div>
        </div>

    </div>
    <style>
        .blog-3-tab {
            height: 570px;
            overflow-y: scroll;
        }

        .blog-3-tab::-webkit-scrollbar {
            width: 2px;
        }

        .blog-3-tab::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px #2e3240;
            border-radius: 10px;
        }

        .blog-3-tab::-webkit-scrollbar-thumb {
            background: #4e65ff;
            border-radius: 15px;
        }
        .sec-blog-3 .blog-3-tab .card-post .post-video-icon .xts-play_icon{
            width: 40px;
            height: 40px;
        }
    </style>
</section>
