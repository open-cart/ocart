@props(['title' => '', 'url' => 'javascript:void(0)'])

@php
    $blog = json_decode(theme_options()->getOption('blog1', 0), true);
    if ($blog == 0){
        $posts = get_list_posts(7);
    }else{
        $category = get_post_category($blog);
        $title = $category->name;
        $url = $category->url;
        $posts = get_list_posts_category($blog, 7);
    }
@endphp

<section class="sec-blog section-custom">
    <div class="container-custom">
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
        <div class="grid grid-cols-1 md:grid-cols-7 md:gap-8">
            <div class="col-span-2">
                @foreach($posts as $key => $post)
                    @if($key <= 1)
                    <div>
                        <x-theme::card.post :data="$post"/>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="col-span-3">
                @if($posts->count() > 2)
                <div>
                    <x-theme::card.post
                        :data="$posts[2]"
                        :deps="true"
                        classTitle="md:text-3xl md:mb-2"
                        :ratio="0.72"
                        sizeImage="large"
                    />
                </div>
                @endif
            </div>
            <div class="col-span-2">
                @foreach($posts as $key => $post)
                    @if($key >= 3)
                    <div class="mb-6 pb-6 @if($key + 1 < $posts->count()) border-b border-dotted border-gray-400 @endif">
                        <x-theme::card.post
                            :data="$post"
                            type="thumb-right"
                            :ratio="0.1"
                            :contentgrow="1.6"
                            :categoryType="2"
                        />
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</section>
