<section class="sec-blog8 section-custom antialiased">
    <div class="container-custom">
        <div class="sec-heading mx-auto lg:mb-8">
            <h2 class="text-xl md:text-2xl font-bold">
                {{ theme_options()->getOption('title_blog8', '') }}
            </h2>
        </div>
        <div class="lg:grid lg:grid-cols-12">
            <div class="lg:col-span-3 lg:mr-8 mb-4 lg:mb-0">
                <ul>
                    @php $categories = get_blog_categories() @endphp
                    @foreach($categories as $category)
                        <li class="py-3 pl-5 lg:text-lg border-b border-dashed border-gray-300 relative">
                            <a href="{{ $category->url }}"
                               data-body="category-container"
                               class="font-bold text-blue-600 block hover:underline"
                            >
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <style>
                    .sec-blog8 li:before {
                        content: "";
                        display: block;
                        width: 8px;
                        height: 8px;
                        background: #294b75;
                        border-radius: 8px;
                        position: absolute;
                        top: 50%;
                        left: 0;
                        margin-top: -4px;
                    }
                </style>
            </div>
            <div class="col-span-9">
                <div class="lg:grid lg:grid-cols-2 gap-8">
                    @php
                        $posts = get_list_posts_feature(5);
                    @endphp
                    @if($posts->count() > 0)
                        <div>
                            <x-theme::card.post :data="$posts[0]" :deps="true" :postMeta="false"/>
                        </div>
                    @endif
                    <div class="w-full">
                        @foreach($posts as $key => $post)
                            @if($key >= 1)
                                <div class="mb-2 pb-2">
                                    <x-theme::card.post
                                        :data="$post"
                                        type="thumb-left"
                                        :ratio="0.1"
                                        :contentgrow="1.6"
                                        :categoryType="2"
                                        :video="false"
                                        :transform="false"
                                    />
                                </div>

                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
