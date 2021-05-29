<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @php
        $banner = get_banner();
        $sections = get_config_sections();
        $categories = get_categories();
    @endphp

    <div class="image-cover hero-banner bg-no-repeat bg-cover bg-center"
         style="background-image:url({{ $banner }});">
        @if(is_active_plugin('contact'))
            <div class="container-custom py-10 md:py-20">
                <x-theme::form.contact id="contact-index" class="bg-white p-4 md:p-10 pt-5 md:pt-8 shadow-md"/>
            </div>
        @endif
    </div>

    @if(is_active_plugin('ecommerce') && !empty($categories) && $sections != null && in_array('categories_product', $sections->value))
        <section class="antialiased font-sans pt-16">
            <div class="container-custom">
                <div class="flex flex-wrap -mx-2">
                    @foreach($categories as $category)
                    <div class="w-1/2 sm:w-1/3 md:w-1/4 xl:w-1/6 p-2 hover:shadow-xl text-center">
                        <a href="" class="p-2 border border-gray-300 inline-block w-full">
                            <img src="{{ TnMedia::url(!empty($category->image) || asset('/images/no-image.jpg')) }}" class="w-full block m-auto rounded-full p-2">
                            <div class="text-gray-600 font-bold line-clamp-1">{{ $category->name }}</div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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

</x-guest-layout>
