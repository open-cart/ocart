<div class="lg:w-1/4 w-full px-0 lg:pr-4 mb-4">
    @if(is_active_plugin('ecommerce'))
        <div class="mb-4">
            <div class="mb-2 font-bold">Danh mục sản phẩm</div>
            <ul>
                @foreach(get_categories() as $category)
                    <li>
                        <a
                                data-body="category-container"
                                href="/product-category/{{ $category->slug }}"
                                class="text-sm font-semibold block text-gray-500 hover:text-blue-600">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(is_active_plugin('blog'))
        <div class="pt-4 mb-4 border-t border-gray-200">
            <div class="mb-2 font-bold">Danh mục bài viết</div>
            <ul>
                @foreach(get_blog_categories() as $category)
                    <li>
                        <a href="/post-category/{{ $category->slug }}"
                           data-body="category-container"
                           class="text-sm font-semibold block text-gray-500 hover:text-blue-600">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(is_active_plugin('blog'))
        <div class="pt-4 border-t border-gray-200">
            <div class="mb-4 font-bold">Bài viết nổi bật</div>
            <ul>
                @foreach(get_list_posts_feature(5) as $post)
                    <li class="mb-4 pb-4 border-b border-dotted">
                        <x-theme::card.post-horizontal :data="$post"/>

                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(is_active_plugin('ecommerce'))
        <div class="pt-4 border-t border-gray-200">
            <div class="mb-4 font-bold">Sản phẩm nổi bật</div>
            <ul>
                @foreach(get_list_products_feature(5) as $product)
                    <li class="mb-4 pb-4 border-b border-dotted">
                        <x-theme::card.product-horizontal :data="$product"/>

                    </li>
                @endforeach
            </ul>
        </div>
    @endif

</div>