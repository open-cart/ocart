<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @php
        $banner = get_banner();
    @endphp
    @php
        $sections = get_config_sections();
    @endphp

    @include(Theme::getThemeNamespace('config-section/' . $sections->name . '/sec-slide'))

    @if($sections != null && in_array('about', $sections->value))
        @include(Theme::getThemeNamespace('config-section/' . $sections->name . '/sec-about'))
    @endif

    @if(is_active_plugin('ecommerce'))
        @php
            $products = get_list_products_feature(6);
        @endphp
        @if($products)
            <section class="sec-product antialiased bg-gray-100 text-gray-900 font-sans py-16">
                <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
                    <h2 class="text-xl md:text-2xl font-bold">Sản phẩm nổi bật</h2>
                    <p class="text-sm md:text-base text-gray-600">Chúng tôi cho là xứng đáng với họ, và họ đang buộc tội những người ghét người công bình, Nhưng, sự thật,
                        và bị hư hỏng bởi những lời xu nịnh của hiện tại, và những nỗi đau này, thú vui đã xóa bỏ</p>
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
    @if($sections != null && in_array('feedback', $sections->value))
        @include(Theme::getThemeNamespace('config-section/' . $sections->name . '/sec-feedback'))
    @endif
    @if(is_active_plugin('blog'))
        <section class="sec-post antialiased bg-gray-100 font-sans py-16">
            <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
                <h2 class="text-xl md:text-2xl font-bold">Tin tức mới nhất</h2>
                <p class="text-sm md:text-base text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
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
    @if($sections != null && in_array('partner', $sections->value))
        @include(Theme::getThemeNamespace('config-section/' . $sections->name . '/sec-partner'))
    @endif
    @if(is_active_plugin('distributor'))
        @include(Theme::getThemeNamespace('sections.distributor'))
    @endif


    @if(is_active_plugin('contact') && $sections != null && in_array('contact', $sections->value))
        @include(Theme::getThemeNamespace('config-section/' . $sections->name . '/sec-contact'))
    @endif
    @include(Theme::getThemeNamespace('config-section/' . $sections->name . '/sec-end'))
</x-guest-layout>
