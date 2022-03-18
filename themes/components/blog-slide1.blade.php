@props(['keySlide'=> 'default'])

<section class="sec-blog-slide1 mx-4 lg:mx-auto" style="max-width: 1400px;">
    @php
        $posts = get_list_posts_feature(7);
    @endphp
    <div
        class="{{ 'swiper'.$keySlide }} swiper-main swiper-container my-swiper-main overflow-hidden"
    >
        <div class="swiper-wrapper">
            @foreach($posts as $key => $post)
                <div class="swiper-slide">
                    <x-theme::card.post
                        :data="$post"
                        type="thumb-bg"
                        :ratio="0.45"
                        :categoryType="1"
                        :transform="false"
                        :deps="true"
                        classTitle="md:text-5xl md:mb-4 line-clamp-2"
                        class="justify-center mx-auto"
                        sizeImage="full"
                    />
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <div class="{{ 'swiperThum'.$keySlide }} swiper-thumb swiper-container mx-auto overflow-hidden">
        <div class="swiper-wrapper">
            @foreach($posts as $key => $post)
                <div class="swiper-slide">
                    <x-theme::card.post
                        :data="$post"
                        type="thumb-bg"
                        :ratio="0.75"
                        :categoryType="1"
                        classTitle="md:text-xl md:mb-2 line-clamp-2"
                    />
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .sec-blog-slide1 .my-swiper-main .post-content{
            max-width: 1200px;
            margin: auto;
            justify-content: center;
        }
        .sec-blog-slide1 .my-swiper-main .post-content h3{
            max-width: 750px;
            text-shadow: 5px 2px 4px #000000c4;
        }
        .sec-blog-slide1 .swiper-button-prev{
            top: 81% !important;
            left: 3% !important;
        }
        .sec-blog-slide1 .swiper-button-next{
            top: 81% !important;
            right: 3% !important;
        }
        .sec-blog-slide1 .swiper-main{
            --swiper-navigation-color: #fff;
            --swiper-pagination-color: #fff;
            margin-bottom: -14%;
            z-index:0
        }
        .sec-blog-slide1 .swiper-thumb{
            max-width: 1116px;
            padding: 10px 0;
        }
        @media (max-width: 991px) {
            .sec-blog-slide1 .swiper-main{
                margin-bottom: 0;
            }
            .sec-blog-slide1 .swiper-thumb{
                display: none;
            }
            .sec-blog-slide1 .card-post .post-thumbnail{
                padding-bottom: calc( 0.594 * 100% ) !important;
            }
        }
    </style>
    <script>
        var blogSlide1Thum{{$keySlide}} = new Swiper(".swiperThum{{$keySlide}}", {
            spaceBetween: 30,
            slidesPerView: 3,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var blogSlide1{{$keySlide}} = new Swiper(".swiper{{$keySlide}}", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: blogSlide1Thum{{$keySlide}}
            },
        });
    </script>
</section>
