<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @php
        $sections = get_config_sections();
    @endphp

    @include(Theme::getThemeNamespace('config/base/sec-slide'))

    @if(is_active_plugin('ecommerce') && $sections != null && in_array('categories_product', $sections->value) && !empty(get_categories_feature()))
        <section class="section-custom sec-categories-product bg-white lg:bg-auto antialiased font-sans">
            <div class="container-custom">
                <div class="flex flex-wrap -mx-2 lg:-mx-4">
                    @foreach(parent_recursive(get_categories_feature()) as $category)
                    <div class="w-1/4 xl:w-1/6 p-1 lg:p-4 hover:shadow-xl text-center">
                        <a href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug'=> $category->slug]) !!}" class="inline-block w-full">
                            <img src="{{ TnMedia::url(empty($category->image) ? asset('/images/no-image.jpg') : $category->image) }}" class="w-full block m-auto rounded-full lg:p-4">
                            <div class="text-gray-600 font-bold line-clamp-2 text-xs md:text-base">{{ $category->name }}</div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(!empty($sections) && in_array('about', $sections->value))
        @include(Theme::getThemeNamespace('config/' . $sections->name . '/section/sec-about'))
    @endif

    @if(is_active_plugin('ecommerce') && in_array('products_feture', $sections->value))
        @php
            $products = get_list_products_feature(8);
        @endphp
        @if($products)
            <section class="section-custom sec-product antialiased text-gray-900 font-sans">
                <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
                    <h2 class="text-xl md:text-2xl font-bold">Sản phẩm nổi bật</h2>
{{--                    <p class="text-sm md:text-base text-gray-600">Chúng tôi cho là xứng đáng với họ, và họ đang buộc tội những người ghét người công bình, Nhưng, sự thật,--}}
{{--                        và bị hư hỏng bởi những lời xu nịnh của hiện tại, và những nỗi đau này, thú vui đã xóa bỏ</p>--}}
                </div>
                <div class="container-custom">

                    <div class="flex flex-wrap -mx-2 md:-mx-2">
                        @foreach($products as $product)
                            <div class="w-1/2 lg:w-1/4 p-2 md:p-2">
                                <x-theme::card.product :data="$product"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif

    @if(!empty($sections) && in_array('feedback', $sections->value))
        @include(Theme::getThemeNamespace('config/' . $sections->name . '/section/sec-feedback'))
    @endif

    @if(is_active_plugin('ecommerce') && in_array('products_category', $sections->value))
        @include(Theme::getThemeNamespace('config.base.sec-products-category'))
    @endif

    @if(is_active_plugin('ecommerce') && in_array('products_menu', $sections->value))
        @include(Theme::getThemeNamespace('config.base.sec-products-menu'))
    @endif

    @if(is_active_plugin('blog'))
        <section class="section-custom sec-post antialiased font-sans">
            <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
                <h2 class="text-xl md:text-2xl font-bold">Tin tức mới nhất</h2>
{{--                <p class="text-sm md:text-base text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>--}}
            </div>

            <div class="container-custom">
                @php
                    $posts = get_list_posts_feature(6);
                @endphp
                <div class="flex flex-wrap -mx-2 md:-mx-4">
                    @foreach($posts as $post)
                        <div class="w-1/2 lg:w-1/3 p-2 md:p-4">
                            <x-theme::card.post :data="$post"/>
                        </div>
                    @endforeach
                </div>
            </div>

        </section>
    @endif
    @if(!empty($sections) && in_array('partner', $sections->value))
        @include(Theme::getThemeNamespace('config/' . $sections->name . '/section/sec-partner'))
    @endif
    @if(is_active_plugin('distributor'))
        @include(Theme::getThemeNamespace('sections.distributor'))
    @endif

    @if(is_active_plugin('contact') && !empty($sections) && in_array('contact', $sections->value))
        @include(Theme::getThemeNamespace('config/' . $sections->name . '/section/sec-contact'))
    @endif

    <style>
        section:nth-child(even) {
            background: #ececec63;
        }
        @media (max-width: 1023px) {
            .sec-categories-product{
                background: white !important;
            }
        }
    </style>
</x-guest-layout>
