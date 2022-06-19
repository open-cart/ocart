@props(['keySlide'=> 'default'])

<section class="sec-testimonial section-custom">
    <div class="max-w-6xl mx-auto px-4">
        @if(!empty(theme_options()->getOption('title_main_testimonial1', '')))
            <div class="sec-blog-header lg:py-12">
                <a href="{{ '/' }}" class="text-center section-title-main lg:text-3xl block">
                    {{ theme_options()->getOption('title_main_testimonial1', '') }}
                </a>
            </div>
    @endif
    <!-- Swiper -->
        <div class="{{ 'swiperTestimonial1'.$keySlide }} swiper-container shadow-2xl rounded-lg">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div
                        class="relative lg:flex overflow-hidden"
                    >
                        <div class="h-56 lg:h-auto lg:w-5/12 relative flex items-center justify-center effect">
                            <img
                                class="absolute h-full w-full object-cover lozad"
                                data-src="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_testimonial1', null)) ? theme_options()->getOption('image_testimonial1', null) . '?w=400' : asset('/images/no-image.jpg')) }}"
                                data-srcset="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_testimonial1', null)) ? theme_options()->getOption('image_testimonial1', null) . '?w=400' : asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_testimonial1', null)) ? theme_options()->getOption('image_testimonial1', null) . '?w=600' : asset('/images/no-image.jpg')) }} 2000w"
                                src="{{ asset('/images/no-image.jpg') }}"
                                alt="{{ theme_options()->getOption('title_testimonial1', '') }}"
                            />
                            <div class="absolute inset-0 bg-indigo-900 opacity-20"></div>
                        </div>
                        <div class="relative lg:w-7/12 bg-white">
                            <svg class="absolute h-full text-white w-24 -ml-12" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <polygon points="50,0 100,0 50,100 0,100"/>
                            </svg>
                            <div class="relative py-4 lg:py-24 px-4 lg:px-16 text-gray-700 leading-relaxed">
                                <p>
                                    {{ theme_options()->getOption('deps_testimonial1', '') }}
                                </p>
                                <p class="mt-6 animate-bounce">
                                    <a
                                        href="{{ !empty(theme_options()->getOption('link_testimonial1', '')) ? theme_options()->getOption('link_testimonial1', '') : 'javascript:void(0)'}}"
                                        class="font-medium text-blue-600 hover:text-blue-900"
                                    >
                                        {{ theme_options()->getOption('title_testimonial1', '') }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="relative lg:flex overflow-hidden"
                    >
                        <div class="h-56 lg:h-auto lg:w-5/12 relative flex items-center justify-center effect">
                            <img
                                class="absolute h-full w-full object-cover lozad"
                                data-src="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_testimonial1_2', null)) ? theme_options()->getOption('image_testimonial1_2', null) . '?w=400' : asset('/images/no-image.jpg')) }}"
                                data-srcset="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_testimonial1_2', null)) ? theme_options()->getOption('image_testimonial1_2', null) . '?w=400' : asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_testimonial1_2', null)) ? theme_options()->getOption('image_testimonial1_2', null) . '?w=600' : asset('/images/no-image.jpg')) }} 2000w"
                                src="{{ asset('/images/no-image.jpg') }}"
                                alt="{{ theme_options()->getOption('title_testimonial1_2', '') }}"
                            />
                            <div class="absolute inset-0 bg-indigo-900 opacity-20"></div>
                        </div>
                        <div class="relative lg:w-7/12 bg-white">
                            <svg class="absolute h-full text-white w-24 -ml-12" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <polygon points="50,0 100,0 50,100 0,100"/>
                            </svg>
                            <div class="relative py-4 lg:py-24 px-4 lg:px-16 text-gray-700 leading-relaxed">
                                <p>
                                    {{ theme_options()->getOption('deps_testimonial1_2', '') }}
                                </p>
                                <p class="mt-6 animate-bounce">
                                    <a
                                        href="{{ !empty(theme_options()->getOption('link_testimonial1_2', '')) ? theme_options()->getOption('link_testimonial1_2', '') : 'javascript:void(0)'}}"
                                        class="font-medium text-blue-600 hover:text-blue-900"
                                    >
                                        {{ theme_options()->getOption('title_testimonial1_2', '') }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="relative lg:flex overflow-hidden"
                    >
                        <div class="h-56 lg:h-auto lg:w-5/12 relative flex items-center justify-center effect">
                            <img
                                class="absolute h-full w-full object-cover lozad"
                                data-src="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_testimonial1_3', null)) ? theme_options()->getOption('image_testimonial1_3', null) . '?w=400' : asset('/images/no-image.jpg')) }}"
                                data-srcset="{{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_testimonial1_3', null)) ? theme_options()->getOption('image_testimonial1_3', null) . '?w=400' : asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(!empty(theme_options()->getOption('image_testimonial1_3', null)) ? theme_options()->getOption('image_testimonial1_3', null) . '?w=600' : asset('/images/no-image.jpg')) }} 2000w"
                                src="{{ asset('/images/no-image.jpg') }}"
                                alt="{{ theme_options()->getOption('title_testimonial1_3', '') }}"
                            />
                            <div class="absolute inset-0 bg-indigo-900 opacity-20"></div>
                        </div>
                        <div class="relative lg:w-7/12 bg-white">
                            <svg class="absolute h-full text-white w-24 -ml-12" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                                <polygon points="50,0 100,0 50,100 0,100"/>
                            </svg>
                            <div class="relative py-4 lg:py-24 px-4 lg:px-16 text-gray-700 leading-relaxed">
                                <p>
                                    {{ theme_options()->getOption('deps_testimonial1_3', '') }}
                                </p>
                                <p class="mt-6 animate-bounce">
                                    <a
                                        href="{{ !empty(theme_options()->getOption('link_testimonial1_3', '')) ? theme_options()->getOption('link_testimonial1_3', '') : 'javascript:void(0)'}}"
                                        class="font-medium text-blue-600 hover:text-blue-900"
                                    >
                                        {{ theme_options()->getOption('title_testimonial1_3', '') }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
    <script>
        var testimonial1{{$keySlide}} = new Swiper(".swiperTestimonial1{{$keySlide}}", {
            autoplay: {
                delay: 10000,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</section>
