<div class="lg:w-1/4 w-full px-0 lg:pr-4 mb-4">
    @if(is_active_plugin('ecommerce'))
    <div>
        <div>Danh mục sản phẩm</div>
        <ul class="mt-2 mb-4">
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
    <div class="pt-4 border-t border-gray-200">
        <div class="mb-2">Danh mục bài viết</div>
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

</div>