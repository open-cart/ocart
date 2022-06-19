@props(['keySlide'=> 'headerSubBottom'])

<div class="container-custom">
    <div class="lg:pt-2.5 pb-1 header-sub-bottom lg:grid lg:grid-cols-4 lg:gap-4 items-center">
        <div class="col-span-3 grid items-center overflow-hidden py-1.5" style="grid-template-columns: auto 1fr">
            <div class="pr-2.5 mr-3 border-r">
                <div class="flex items-center text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z" />
                    </svg>
                    <span class="font-semibold uppercase ml-1 hidden lg:inline-block">Tin Hot</span>
                </div>
            </div>
            <div class="overflow-hidden" style="line-height: 34px">
                <div
                    class="{{ 'swiper'.$keySlide }} swiper-container my-swiper-main overflow-hidden py-2"
                >
                    <div class="swiper-wrapper z-0">
                        @foreach(get_list_posts_feature(7) as $key => $post)
                            <div class="swiper-slide">
                                <div>
                                    <a href="{{ $post->url }}" class="line-clamp-1">
                                        {{ $post->name }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-navigation-wrapper z-10 hidden lg:inline-block">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="hidden lg:block ml-4">
            <x-theme::form.search id="header-sub-bottom-form-search" type="right"/>
        </div>
    </div>
    <style>
        .header-sub-bottom .swiper-button-next, .header-sub-bottom .swiper-button-prev {
            width: 34px !important;
        }
        .header-sub-bottom .swiper-navigation-wrapper{
            position: absolute;
            right: -5px;
            top: 50%;
            -webkit-transform: translateY(-22px);
            transform: translateY(-22px);
            background: #fff;
            padding-left: 10px;
        }
        .header-sub-bottom .swiper-button-next, .header-sub-bottom .swiper-button-prev{
            position: unset !important;
            display: -webkit-inline-box !important;
            display: -ms-inline-flexbox !important;
            display: inline-flex !important;
            padding: 0 10px;
            margin: 0 5px;
        }
    </style>
    <script>
        var headerSubBottom{{$keySlide}} = new Swiper(".swiper{{$keySlide}}", {
            autoplay: {
                delay: 10000,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
</div>
