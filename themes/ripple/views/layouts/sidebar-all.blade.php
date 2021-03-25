<div class="lg:w-1/4 w-full px-0 lg:pr-4 mb-4">
    <div>
        <div>Danh mục sản phẩm</div>
        <ul class="mt-2 mb-4">
            @foreach(get_categories() as $category)
                <li>
                    <a href="/product-category/{{ $category->id }}" class="text-sm font-semibold block text-gray-500 hover:text-red-500">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="pt-4 border-t border-gray-200">
        <div class="mb-2">Danh mục bài viết</div>
        <ul>
            @foreach(get_blog_categories() as $category)
                <li>
                    <a href="/post-category/{{ $category->id }}" class="text-sm font-semibold block text-gray-500 hover:text-red-500">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>

</div>