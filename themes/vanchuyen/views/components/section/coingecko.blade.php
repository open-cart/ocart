<section class="section-custom">
    <div class="container-custom">
        <div class="mt-4 px-3 pt-6 border-2 border-solid border-red-500 rounded-md">
            @php
                $posts = get_list_posts(10);
            @endphp
            <div
                class="swiper-main swiper-container mySwiperGecko my-swiper-main overflow-hidden"
            >
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

        <script>
            var mySwiperGecko = new Swiper(".mySwiperGecko", {
                spaceBetween: 12,
                slidesPerView: 1,
                freeMode: true,
                loop: true,
                autoplay: {
                    delay: 3000,
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
    </div>
</section>
