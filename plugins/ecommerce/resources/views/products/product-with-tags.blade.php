<div class="-mt-4">
    <x-plugins.ecommerce::products.search-tags
            name="Product"
            :options="$options"
            source="{!! route('ecommerce.product_ajax_search_tags') !!}">
        <x-slot name="first">
            <div class="flex items-center py-2 px-2 pl-5">
                <x-input placeholder="{{ trans('plugins/blog::posts.search_tag') }}"
                         x-on:input.debounce.250="fetchSomething($event)"
                         x-ref="input-search"
                         class="w-full"/>
            </div>
            <hr class="dark:border-gray-600">
        </x-slot>
        <x-slot name="last">
            <hr class="dark:border-gray-600">
            <x-link href="#"
                    x-on:click.prevent="showFormCreate"
                    class="flex items-center hover:bg-blue-50 dark:hover:bg-gray-600 cursor-pointer px-2 pl-5">
                <span class="px-2 py-3">
                    {{ trans('plugins/blog::posts.create_tag') }}
                </span>
            </x-link>

            <x-link href="{{ route('ecommerce.tags.index') }}"
                    class="flex items-center hover:bg-blue-50 dark:hover:bg-gray-600 cursor-pointer px-2 pl-5">
                <span class="px-2 py-3">
                    {{ trans('plugins/blog::posts.manage_tag') }}
                </span>
            </x-link>
        </x-slot>
    </x-plugins.ecommerce::products.search-tags>
</div>
