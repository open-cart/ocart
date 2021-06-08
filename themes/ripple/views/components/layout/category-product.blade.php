@if(is_active_plugin('ecommerce') && in_array('category_product', $sections->value))
    @php
        $category_product = parent_recursive(get_categories_feature());
    @endphp
    @foreach($category_product as $item_category)
        <section class="section-custom sec-product antialiased text-gray-900 font-sans">
            <div class="container-custom">
                <div class="sec-heading flex mb-4 lg:block w-full float-left">
                    <h2 class="flex-1 text-base md:text-2xl font-bold float-left line-clamp-1 mr-2">
                        <a href="{{ route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, $item_category->slug) }}"
                           class="border-b border-yellow-500">{{ $item_category->name }}</a>
                    </h2>
                    @if(!empty($item_category->children) && count($item_category->children) > 0)
                        <span class="float-left">
                        @foreach($item_category->children as $item)
                        <span class="hidden lg:inline-block float-left ml-6 text-md mt-1.5">
                            <a href="{{ route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, $item->slug) }}"
                               class="text-gray-600 hover:text-black">{{ $item->name }}
                            </a>
                        </span>
                        @endforeach
                        </span>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium
                             text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300
                             dark:text-gray-300 dark:hover:text-gray-400 dark:focus:text-gray-400
                             focus:outline-none transition duration-150 ease-in-out lg:hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @foreach($item_category->children as $item)
                                    <a href="{{ route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, $item->slug) }}" class="menu-category-sub-item text-gray-700 block px-4 py-2 text-sm"
                                       role="menuitem" tabindex="-1" id="menu-item-0">{{ $item->name }}
                                    </a>
                                @endforeach
                            </x-slot>

                        </x-dropdown>

                    @endif

                </div>

                <div class="flex flex-wrap -mx-2 md:-mx-2">
                    @foreach(get_list_products_relate($item_category->id, 8) as $product)
                        <div class="w-1/2 lg:w-1/4 p-2 md:p-2">
                            <x-theme::card.product :data="$product"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    @endforeach
@endif
