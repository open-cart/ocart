@props(['keySlide'=> 'default'])

<section class="sec-blog-slide4 section-custom">
    @php
        $blog = json_decode(theme_options()->getOption('blog_slide4', 0), true);
        if ($blog == 0){
            $posts = get_list_posts(7);
        }else{
            $category = get_post_category($blog);
            $title = $category->name;
            $url = $category->url;
            $posts = get_list_posts_category($blog, 7);
        }
    @endphp
    <div class="container-custom">
        <div class="sec-blog-content">
            <div class="{{ 'swiper'.$keySlide }} swiper-container overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach($posts as $key => $post)
                        <div class="swiper-slide">
                            <x-theme::card.post
                                :data="$post"
                                type="thumb-bg"
                                :ratio="1.3"
                                :categoryType="1"
                                :transform="false"
                                classTitle="md:text-2xl md:mb-2 line-clamp-2"
                                rounded="rounded-none"
                                sizeImage="large"
                            />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <style>
        @media (max-width: 768px) {
            .sec-blog-slide4 .card-post .post-thumbnail{
                padding-bottom: calc( 0.594 * 100% ) !important;
            }
        }
    </style>
    <script>
        var blogSlide4{{$keySlide}} = new Swiper(".swiper{{$keySlide}}", {
            spaceBetween: 1,
            slidesPerView: 1,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            autoplay: {
                delay: 10000,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                991: {
                    slidesPerView: 4,
                }
            }
        });
    </script>
</section>
