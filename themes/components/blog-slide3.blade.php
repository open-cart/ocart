@props(['keySlide'=> 'default', 'title' => '', 'url' => 'javascript:void(0)'])

<section {!! $attributes->merge(['class' => 'sec-blog-slide3 section-custom']) !!}>
    @php
        $blog = json_decode(theme_options()->getOption('blog_slide3', 0), true);
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
        @if(!empty($title))
        <div class="sec-blog-header mb-5">
            <div class="separetor block">
                <div class="border-divider"></div>
            </div>
            <a href="{{ $url }}" class="section-title section-title-main block">
                {{ $title }}
            </a>
        </div>
        @endif
        <div
            class="sec-blog-content"
            style="    background-image: url(https://demo.themewinter.com/wp/qoxag/wp-content/uploads/2021/04/shape.png);
    background-position: top left;
    background-repeat: no-repeat;
    background-size: 56% auto;"
        >
            <!-- Swiper -->
            <div class="{{ 'swiper'.$keySlide }} swiper-container overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach($posts as $key => $post)
                        <div class="swiper-slide">
                            <x-theme::card.post
                                :data="$post"
                                type="thumb-right"
                                :ratio="0.3"
                                :contentgrow="1"
                                :categoryType="1"
                                categoryBg="bg-blue-600"
                                :transform="false"
                                classTitle="line-clamp-3"
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
        .sec-blog-slide3 .swiper-wrapper .post-content{
            max-width: 48.2%;
            background-color: #E91E63;
            padding: 0px 50px 50px 50px;
            margin: 30px 30px 40px;
            border-radius: 6px;
        }

        .sec-blog-slide3 .swiper-wrapper .post-content h3{
            color: #FFFFFF;
            font-size: 33px;
            font-weight: 700;
            line-height: 43px;
            letter-spacing: -0.1px;
            margin: 35px 0px 10px 0px;
        }

        .sec-blog-slide3 .swiper-wrapper .post-content .post-meta span, .sec-blog-slide3 .swiper-wrapper .post-content .post-meta svg{
            color: #FFFFFF;
        }

        @media (max-width: 768px) {
            .sec-blog-slide3 .swiper-wrapper .post-content h3{
                font-size: 22px;
                line-height: 24px;
                letter-spacing: normal;
                margin: 35px 0px 10px 0px;
            }
            .sec-blog-slide3 .card-post{
                display: block !important;
            }
            .sec-blog-slide3 .card-post .post-thumbnail{
                padding-bottom: calc( 0.5 * 100% ) !important;
            }
            .sec-blog-slide3 .card-post .post-content{
                flex-grow: 1 !important;
                max-width: 100% !important;
                margin: 10px 0 !important;
            }
        }
    </style>
    <script>
        var blogSlide3{{$keySlide}} = new Swiper(".swiper{{$keySlide}}", {
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
