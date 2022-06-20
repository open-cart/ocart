@props(['keySlide'=> 'default'])

<section {!! $attributes->merge(['class' => 'sec-slide1 section-custom py-0']) !!}>
    <div class="box-slide1">
        <div class="{{ 'swiperSlide1'.$keySlide }} swiper-container overflow-hidden">
            <div class="swiper-wrapper">
                @if(!empty(theme_options()->getOption('slide1', null)))
                    <div class="swiper-slide">
                        <a
                            href="{{ theme_options()->getOption('link_slide1', 'javascript:void(0)') }}"
                            class="inline-block w-full"
                        >
                            <img
                                data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1', null) . '?w=1920', asset('/images/no-image.jpg')) }}"
                                src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1', null) . '?w=100', asset('/images/no-image.jpg')) }}"
                                alt="banner home 1"
                                class="mx-auto lozad w-full hidden md:inline-block"
                                width="1200"
                                height="554"
                            >

                            <img
                                data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_mobile', null) . '?w=600', asset('/images/no-image.jpg')) }}"
                                src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_mobile', null) . '?w=100', asset('/images/no-image.jpg')) }}"
                                alt="banner home 1 mobile"
                                class="mx-auto lozad w-full md:hidden"
                                width="750"
                                height="820"
                            >
                        </a>
                    </div>
                @endif
                @if(!empty(theme_options()->getOption('slide1_2', null)))
                    <div class="swiper-slide">
                        <a
                            href="{{ theme_options()->getOption('link_slide1_2', 'javascript:void(0)') }}"
                            class="inline-block w-full"
                        >
                            <img
                                data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_2', null) . '?w=1920', asset('/images/no-image.jpg')) }}"
                                src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_2', null) . '?w=100', asset('/images/no-image.jpg')) }}"
                                alt="banner home 2"
                                class="mx-auto lozad w-full hidden md:inline-block"
                                width="1200"
                                height="554"
                            >

                            <img
                                data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_2_mobile', null) . '?w=600', asset('/images/no-image.jpg')) }}"
                                src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_2_mobile', null) . '?w=100', asset('/images/no-image.jpg')) }}"
                                alt="banner home 2 mobile"
                                class="mx-auto lozad w-full md:hidden"
                                width="750"
                                height="820"
                            >
                        </a>
                    </div>
                @endif
                @if(!empty(theme_options()->getOption('slide1_3', null)))
                    <div class="swiper-slide">
                        <a
                            href="{{ theme_options()->getOption('link_slide1_3', 'javascript:void(0)') }}"
                            class="inline-block w-full"
                        >
                            <img
                                data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_3', null) . '?w=1920', asset('/images/no-image.jpg')) }}"
                                src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_3', null) . '?w=100', asset('/images/no-image.jpg')) }}"
                                alt="banner home 3"
                                class="mx-auto lozad w-full hidden md:inline-block"
                                width="1200"
                                height="554"
                            >

                            <img
                                data-src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_3_mobile', null) . '?w=600', asset('/images/no-image.jpg')) }}"
                                src="{{ TnMedia::getImageUrl(theme_options()->getOption('slide1_3_mobile', null) . '?w=100', asset('/images/no-image.jpg')) }}"
                                alt="banner home 3 mobile"
                                class="mx-auto lozad w-full md:hidden"
                                width="750"
                                height="820"
                            >
                        </a>
                    </div>
                @endif
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <script>
        var slide1{{$keySlide}} = new Swiper(".swiperSlide1{{$keySlide}}", {
            spaceBetween: 1,
            slidesPerView: 1,
            autoplay: {
                delay: 5000,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</section>
