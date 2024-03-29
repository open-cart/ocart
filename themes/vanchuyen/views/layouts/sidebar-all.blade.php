<div class="lg:w-1/4 w-full px-0 lg:pr-4 mb-4">
    @if(is_active_plugin('ecommerce'))
        <div class="mb-4">
            <div class="mb-2 font-bold">Danh mục sản phẩm</div>
            <ul class="menu-category-product">
                @foreach(parent_recursive(get_categories()) as $category)
                    <li class="py-0.5">
                        <a
                                data-body="category-container"
                                href="{{ $category->url }}"
                                class="text-sm font-semibold block text-gray-500 hover:text-blue-600">
                            {{ $category->name }}
                        </a>
                        @if(!empty($category->children) && count($category->children)>0)
                        <ul class="submenu1-category-product ml-4">
                            @foreach($category->children as $subitem)
                                <li class="py-0.5">
                                    <a data-body="category-container"
                                        href="{{ $subitem->url }}"
                                        class="text-sm font-semibold block text-gray-500 hover:text-blue-600">
                                        {{ $subitem->name }}
                                    </a>

                                    @if(!empty($subitem->children) && count($subitem->children)>0)
                                        <ul class="submenu1-category-product ml-4">
                                            @foreach($subitem->children as $subitem2)
                                                <li class="py-0.5">
                                                    <a data-body="category-container"
                                                       href="{{ $subitem2->url }}"
                                                       class="text-sm font-semibold block text-gray-500 hover:text-blue-600">
                                                        {{ $subitem2->name }}
                                                    </a>
                                                </li>

                                            @endforeach
                                        </ul>
                                    @endif
                                </li>

                            @endforeach
                        </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(is_active_plugin('blog'))
        <div class="pt-4 mb-4 border-t border-gray-200">
            <div class="mb-2 font-bold">Danh mục bài viết</div>
            <ul>
                @php $categories = get_blog_categories() @endphp
                @foreach($categories as $category)
                    <li class="py-0.5">
                        <a href="{{ $category->url }}"
                           data-body="category-container"
                           class="text-sm font-semibold block text-gray-500 hover:text-blue-600">{{ $category->name }}</a>
                        @if($category->child_cats->isNotEmpty())
                            <ul class="submenu1-category-product ml-4">
                                @foreach($category->child_cats as $subitem)
                                    <li class="py-0.5">
                                        <a data-body="category-container"
                                           href="{{ $subitem->url }}"
                                           class="text-sm font-semibold block text-gray-500 hover:text-blue-600">
                                            {{ $subitem->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
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
