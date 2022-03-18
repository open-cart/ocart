@props(['keySlide'=> 'default'])

<section class="sec-about2 section-custom">
    <div class="container-custom">
        @if(!empty(theme_options()->getOption('title_main_about2', '')))
            <div class="sec-blog-header mb-5">
                <div class="separetor block">
                    <div class="border-divider"></div>
                </div>
                <a href="{{ theme_options()->getOption('link_main_about2', '') }}" class="section-title section-title-main block">
                    {{ theme_options()->getOption('title_main_about2', '') }}
                </a>
            </div>
        @endif
        <div class="mt-4">
            <div class="{{ 'swiper'.$keySlide }} swiper-main swiper-container mySwiperGecko my-swiper-main overflow-hidden">
                <div class="swiper-wrapper">
                    <div class="swiper-slide px-1 py-2 lg:py-4">
                        <div
                            class="bg-cover bg-center relative top-0 shadow-md"
                            style="background-image:url({{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about2', null)) ? theme_options()->getOption('image_about2', null) . '?w=400' : asset('/images/no-image.jpg')) }});padding-top: 70%;background-size: cover;"
                        >
                            <a
                                href="javascript:void(0)"
                                class="absolute bottom-0 left-0 px-5 py-2 bg-white font-bold lg:text-2xl"
                            >
                                {{ theme_options()->getOption('title_about2', '') }}
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide px-1 py-2 lg:py-4">
                        <div
                            class="bg-cover bg-center relative top-0 shadow-md"
                            style="background-image:url({{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about2_2', null)) ? theme_options()->getOption('image_about2_2', null) . '?w=400' : asset('/images/no-image.jpg')) }});padding-top: 70%;background-size: cover;"
                        >
                            <a
                                href="javascript:void(0)"
                                class="absolute bottom-0 left-0 px-5 py-2 bg-white font-bold lg:text-2xl"
                            >
                                {{ theme_options()->getOption('title_about2_2', '') }}
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide px-1 py-2 lg:py-4">
                        <div
                            class="bg-cover bg-center relative top-0 shadow-md"
                            style="background-image:url({{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about2_3', null)) ? theme_options()->getOption('image_about2_3', null) . '?w=400' : asset('/images/no-image.jpg')) }});padding-top: 70%;background-size: cover;"
                        >
                            <a
                                href="javascript:void(0)"
                                class="absolute bottom-0 left-0 px-5 py-2 bg-white font-bold lg:text-2xl"
                            >
                                {{ theme_options()->getOption('title_about2_3', '') }}
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide px-1 py-2 lg:py-4">
                        <div
                            class="bg-cover bg-center relative top-0 shadow-md"
                            style="background-image:url({{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about2_4', null)) ? theme_options()->getOption('image_about2_4', null) . '?w=400' : asset('/images/no-image.jpg')) }});padding-top: 70%;background-size: cover;"
                        >
                            <a
                                href="javascript:void(0)"
                                class="absolute bottom-0 left-0 px-5 py-2 bg-white font-bold lg:text-2xl"
                            >
                                {{ theme_options()->getOption('title_about2_4', '') }}
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide px-1 py-2 lg:py-4">
                        <div
                            class="bg-cover bg-center relative top-0 shadow-md"
                            style="background-image:url({{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_about2_5', null)) ? theme_options()->getOption('image_about2_5', null) . '?w=400' : asset('/images/no-image.jpg')) }});padding-top: 70%;background-size: cover;"
                        >
                            <a
                                href="javascript:void(0)"
                                class="absolute bottom-0 left-0 px-5 py-2 bg-white font-bold lg:text-2xl"
                            >
                                {{ theme_options()->getOption('title_about2_5', '') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        var about2{{$keySlide}} = new Swiper(".swiper{{$keySlide}}", {
            spaceBetween: 25,
            slidesPerView: 1,
            freeMode: true,
            autoplay: {
                delay: 5000,
            },
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            breakpoints: {
                991: {
                    slidesPerView: 3,
                }
            }
        });
    </script>
</section>
