<div class="-mt-4">
    <x-plugins.blog::posts.input-search
            name="Product"
            :options="$options"
            source="{!! route('ajax_search_tags') !!}">
        <x-slot name="first">
            <div class="flex items-center py-2 px-2 pl-5">
                <x-input placeholder="{{ trans('plugins/blog::posts.search_tag') }}"
                         x-on:input.debounce.250="fetchSomething($event)"
                         class="w-full"/>
            </div>
            <hr class="dark:border-gray-600">
        </x-slot>
        <x-slot name="last">
            <div class="flex items-center hover:bg-blue-50 dark:hover:bg-gray-600 cursor-pointer px-2 pl-5"
                 data-toggle="modal"
                 data-target="#order-create-customer-modal">
{{--                <x-icons.plus class="w-6 h-8"/>--}}
                <span class="px-2 py-3">
                    {{ trans('plugins/blog::posts.create_tag') }}
                </span>
            </div>
            <hr class="dark:border-gray-600">
            <div class="flex items-center hover:bg-blue-50 dark:hover:bg-gray-600 cursor-pointer px-2 pl-5"
                 data-toggle="modal"
                 data-target="#order-create-customer-modal">
{{--                <img src="//hstatic.net/0/0/global/design/imgs/next-create-customer.svg" alt="user" class="w-8">--}}
                <span class="px-2 py-3">
                    {{ trans('plugins/blog::posts.manage_tag') }}
                </span>
            </div>
        </x-slot>
    </x-plugins.blog::posts.input-search>
</div>
