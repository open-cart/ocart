@props(['keySlide'=> 'default'])

<section class="sec-blog-slide2 section-custom">
    @php
        $posts = get_list_posts_feature(7);
    @endphp
    <div class="container-custom">
        <div class="mt-4 px-3 pt-6 border-2 border-solid border-red-500 rounded-md">
            <div class="{{ 'swiper'.$keySlide }} swiper-main swiper-container mySwiperGecko my-swiper-main overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach($posts as $key => $post)
                        <div class="swiper-slide">
                            <x-theme::card.post
                                :data="$post"
                                type="thumb-top"
                                :ratio="0.75"
                                :categoryType="1"
                                :postMeta="false"
                                classTitle="md:text-base md:mb-0 line-clamp-2"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        var blogSlide2{{$keySlide}} = new Swiper(".swiper{{$keySlide}}", {
            spaceBetween: 12,
            slidesPerView: 1,
            freeMode: true,
            autoplay: {
                delay: 10000,
            },
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            breakpoints: {
                991: {
                    slidesPerView: 5,
                }
            }
        });
    </script>
</section>
