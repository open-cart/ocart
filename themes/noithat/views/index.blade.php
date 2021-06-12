<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @php
        $sections = get_config_sections();
    @endphp

    @include(Theme::getThemeNamespace('config/base/sec-slide'))

    @if(is_active_plugin('ecommerce') && $sections != null && in_array('categories_product', Arr::get($sections, 'value', [])) && !empty(get_categories_feature()))
        <section class="section-custom sec-categories-product bg-white lg:bg-auto antialiased font-sans">
            <div class="container-custom">
                <div class="w-full grid grid-cols-6 lg:grid-cols-9 gap-2 lg:gap-4">
                    @foreach(parent_recursive(get_categories_feature()) as $category)
                        <div class="text-center rounded-t-full hover:shadow-xl">
                            <a href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug'=> $category->slug]) !!}" class="inline-block w-full">
                                <img src="{{ TnMedia::url(empty($category->image) ? asset('/images/no-image.jpg') : $category->image) }}" class="w-full block m-auto rounded-full lg:p-3" style="background-image: linear-gradient(180deg, #ffffff, #f8f8f800);">
                                <div class="text-gray-600 font-bold line-clamp-2 text-xs md:text-base">{{ $category->name }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
{{--                --}}
{{--                <div class="flex flex-wrap -mx-2 lg:-mx-4">--}}
{{--                    @foreach(parent_recursive(get_categories_feature()) as $category)--}}
{{--                    <div class="w-1/4 xl:w-1/6 p-1 lg:p-4 hover:shadow-xl text-center">--}}
{{--                        <a href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug'=> $category->slug]) !!}" class="inline-block w-full">--}}
{{--                            <img src="{{ TnMedia::url(empty($category->image) ? asset('/images/no-image.jpg') : $category->image) }}" class="w-full block m-auto rounded-full lg:p-4">--}}
{{--                            <div class="text-gray-600 font-bold line-clamp-2 text-xs md:text-base">{{ $category->name }}</div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
            </div>
        </section>
    @endif

    @if(!empty($sections) && in_array('about', Arr::get($sections, 'value', [])))
        @include(Theme::getThemeNamespace('config/' . Arr::get($sections, 'name', '') . '/section/sec-about'))
    @endif

    @if(is_active_plugin('ecommerce') && in_array('products_feture', Arr::get($sections, 'value', [])))
        @php
            $products_feature = get_list_products_feature(8);
        @endphp
        @if(!empty($products_feature) && count($products_feature)>0)
            <section class="section-custom sec-product antialiased text-gray-900 font-sans">
                <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
                    <h2 class="text-xl md:text-2xl font-bold">Sản phẩm bán chạy</h2>
{{--                    <p class="text-sm md:text-base text-gray-600">Chúng tôi cho là xứng đáng với họ, và họ đang buộc tội những người ghét người công bình, Nhưng, sự thật,--}}
{{--                        và bị hư hỏng bởi những lời xu nịnh của hiện tại, và những nỗi đau này, thú vui đã xóa bỏ</p>--}}
                </div>
                <div class="container-custom">
                    <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                        @foreach($products_feature as $product)
                            <div>
                                <x-theme::card.product :data="$product"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif

    @if(is_active_plugin('ecommerce') && in_array('products_new', Arr::get($sections, 'value', [])))
        @php
            $products_new = get_list_products_new(8);
        @endphp
        @if(!empty($products_new) && count($products_new)>0)
            <section class="section-custom sec-product antialiased text-gray-900 font-sans">
                <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
                    <h2 class="text-xl md:text-2xl font-bold">Sản phẩm khuyến mãi mới nhất</h2>
                    {{--                    <p class="text-sm md:text-base text-gray-600">Chúng tôi cho là xứng đáng với họ, và họ đang buộc tội những người ghét người công bình, Nhưng, sự thật,--}}
                    {{--                        và bị hư hỏng bởi những lời xu nịnh của hiện tại, và những nỗi đau này, thú vui đã xóa bỏ</p>--}}
                </div>
                <div class="container-custom">
                    <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                        @foreach($products_new as $product)
                            <div>
                                <x-theme::card.product :data="$product"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif

    @if(!empty($sections) && in_array('feedback', Arr::get($sections, 'value', [])))
        @include(Theme::getThemeNamespace('config/' . Arr::get($sections, 'name', '') . '/section/sec-feedback'))
    @endif

    @if(is_active_plugin('ecommerce') && in_array('products_category', Arr::get($sections, 'value', [])))
        @include(Theme::getThemeNamespace('config.base.sec-products-category'))
    @endif

    @if(is_active_plugin('ecommerce') && in_array('products_menu', Arr::get($sections, 'value', [])))
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
                <div class="w-full grid grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4">
                    @foreach($posts as $post)
                        <div>
                            <x-theme::card.post :data="$post"/>
                        </div>
                    @endforeach
                </div>
            </div>

        </section>
    @endif
    @if(!empty($sections) && in_array('partner', Arr::get($sections, 'value', [])))
        @include(Theme::getThemeNamespace('config/' . Arr::get($sections, 'name', '') . '/section/sec-partner'))
    @endif
    @if(is_active_plugin('distributor'))
        @include(Theme::getThemeNamespace('sections.distributor'))
    @endif

    @if(is_active_plugin('contact') && !empty($sections) && in_array('contact', Arr::get($sections, 'value', [])))
        @include(Theme::getThemeNamespace('config/' . Arr::get($sections, 'name', '') . '/section/sec-contact'))
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
