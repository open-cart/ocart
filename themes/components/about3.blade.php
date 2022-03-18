<section class="sec-about3 section-custom bg-gray-50 pt-4 pb-12">
    <div class="container-custom" style="    background: url('https://vicone.vn/static/media/map.775194b6.png') center center no-repeat;">
        @if(!empty(theme_options()->getOption('title_main_about3', '')))
            <div class="sec-blog-header lg:py-12">
                <a href="{{ theme_options()->getOption('link_main_about3', '') }}" class="text-center section-title-main block">
                    {{ theme_options()->getOption('title_main_about3', '') }}
                </a>
            </div>
        @endif
        <div class="mt-4 grid lg:grid-cols-2 gap-8">
            <div class="content-left">
                <div class="item flex items-center my-6 lg:my-8">
                    <div class="mr-4 lg:mr-8">
                        {!! theme_options()->getOption('icon_about3', '') !!}
                    </div>
                    <div>
                        <div class="font-bold lg:text-2xl">
                            {{ theme_options()->getOption('title_about3', '') }}
                        </div>
                        <div class="text-gray-500">
                            {{ theme_options()->getOption('deps_about3', '') }}
                        </div>
                    </div>
                </div>
                <div class="item flex items-center my-6 lg:my-8">
                    <div class="mr-4 lg:mr-8">
                        {!! theme_options()->getOption('icon_about3_2', '') !!}
                    </div>
                    <div>
                        <div class="font-bold lg:text-2xl">
                            {{ theme_options()->getOption('title_about3_2', '') }}
                        </div>
                        <div class="text-gray-500">
                            {{ theme_options()->getOption('deps_about3_2', '') }}
                        </div>
                    </div>
                </div>
                <div class="item flex items-center my-6 lg:my-8">
                    <div class="mr-4 lg:mr-8">
                        {!! theme_options()->getOption('icon_about3_3', '') !!}
                    </div>
                    <div>
                        <div class="font-bold lg:text-2xl">
                            {{ theme_options()->getOption('title_about3_3', '') }}
                        </div>
                        <div class="text-gray-500">
                            {{ theme_options()->getOption('deps_about3_3', '') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-right">
                <img
                    data-src="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about3', null)) ? theme_options()->getOption('image_about3', null) . '?w=550' : asset('/images/no-image.jpg')) }}"
                    src="{{ asset('/images/no-image.jpg') }}"
                    alt="{{ theme_options()->getOption('title_main_about3', '') }}"
                    class="lozad"
                >
            </div>
        </div>
    </div>
</section>
