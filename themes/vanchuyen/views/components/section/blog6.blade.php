<section class="sec-blog6 section-custom antialiased">
    <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-8">
        <h2 class="text-xl md:text-2xl font-bold">
            {{ theme_options()->getOption('title_blog6', '') }}
        </h2>
        <p class="text-sm md:text-base text-gray-600">
            {{ theme_options()->getOption('deps_blog6', '') }}
        </p>
    </div>

    <div class="container-custom">
        @php
            $posts = get_list_posts_feature(6);
        @endphp
        <div class="w-full grid grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4">
            @foreach($posts as $post)
                <x-theme::card.post :data="$post" :video="true"/>
            @endforeach
        </div>
    </div>

</section>
