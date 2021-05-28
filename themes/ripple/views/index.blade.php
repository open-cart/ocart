<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    @php
        $banner = get_banner();
    @endphp
    @php
        $sections = get_config_sections();
    @endphp

    <div class="image-cover hero-banner bg-no-repeat bg-cover bg-center"
         style="background-image:url({{ $banner }});">
        @if(is_active_plugin('contact'))
            <div class="container-custom py-10 md:py-20">
                <x-theme::form.contact id="contact-index" class="bg-white p-4 md:p-10 pt-5 md:pt-8 shadow-md"/>
            </div>
        @endif
    </div>

    <div class="container-custom grid xl:grid-cols-6 xl:grid-rows-2 mx-auto gap-x-4 my-8 gap-y-6 md:grid-cols-4 md:grid-rows-3 grid-cols-2">
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-thoi-trang-nam-1-150x150.jpg" class="w-full block m-auto">
            <a href="" class="text-gray-600 font-bold">Thời Trang Nam</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-thoi-trang-nu-1.jpg" class="block m-auto">
            <a href="" class="text-gray-600 font-bold">Thời Trang Nữ</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-thiet-bi-nghe-nhin-1.jpg" class=" block m-auto">
            <a href="" class="text-gray-600 font-bold">Thiết Bị Nghe Nhìn</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-may-tinh-lap-top-1.jpg" class="block m-auto">
            <a href="" class="text-gray-600 font-bold">Máy Tính & Laptop</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-the-thao-1.jpg" class="block m-auto">
            <a href="" class="text-gray-600 font-bold">Thể Thao</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-phu-kien-thu-cung-1.jpg" class="block m-auto   ">
            <a href="" class="text-gray-600 font-bold">Phụ Kiện & Thú Cưng</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-giay-dep-nu-1.jpg" class="block m-auto   ">
            <a href="" class="text-gray-600 font-bold">Giày Dép Nữ</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-giay-nam-1.jpg" class="block m-auto   ">
            <a href="" class="text-gray-600 font-bold">Giày Dép Nam</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-dien-thoai-1.jpg" class="block m-auto   ">
            <a href="" class="text-gray-600 font-bold">Phụ Kiện Điện Thoại</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-Thiet-bi-van-phong-1.jpg" class="block m-auto   ">
            <a href="" class="text-gray-600 font-bold">Thiết Bị Văn Phòng</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-do-choi-1.jpg" class="block m-auto   ">
            <a href="" class="text-gray-600 font-bold">Đồ Chơi</a>
        </div>
        <div class="text-center border p-2 border-gray-600 hover:shadow-xl">
            <img src="https://mua1.xyz/wp-content/uploads/2021/05/hinh-anh-sach-1.jpg" class="block m-auto">
            <a href="" class="text-gray-600 font-bold">Sách</a>
        </div>


    </div>

    @if($sections != null && in_array('about', $sections->value))
        @include(Theme::getThemeNamespace('config-section/' . $sections->name . '/sec-about'))
    @endif

    @if(is_active_plugin('ecommerce'))
        <section class="sec-product antialiased bg-gray-100 text-gray-900 font-sans py-16">
            <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
                <h2 class="text-xl md:text-2xl font-bold">Sản phẩm nổi bật</h2>
                <p class="text-sm md:text-base text-gray-600">Chúng tôi cho là xứng đáng với họ, và họ đang buộc tội những người ghét người công bình, Nhưng, sự thật,
                    và bị hư hỏng bởi những lời xu nịnh của hiện tại, và những nỗi đau này, thú vui đã xóa bỏ</p>
            </div>
            <div class="container-custom">
                @php
                    $products = get_list_products_feature(6);
                @endphp
                <div class="flex flex-wrap -mx-2 md:-mx-4">
                    @foreach($products as $product)
                        <div class="w-1/2 lg:w-1/3 p-2 md:p-4">
                            <x-theme::card.product :data="$product"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
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
