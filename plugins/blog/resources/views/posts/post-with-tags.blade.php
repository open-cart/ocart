<div class="-mt-4">
    <x-plugins.blog::posts.input-search
            name="Product"
            :options="$options"
            source="{!! route('ajax_search_tags') !!}">
        <x-slot name="first">
            <div class="flex items-center py-2 px-2 pl-5">
                <x-input x-ref="input-search" placeholder="{{ trans('plugins/blog::posts.search_tag') }}"
                         x-on:input.debounce.250="fetchSomething($event)"
                         class="w-full"/>
            </div>
            <hr class="dark:border-gray-600">
        </x-slot>
        <x-slot name="last">
            <hr class="dark:border-gray-600">
            <x-link href="#"
                    class="flex items-center hover:bg-blue-50 dark:hover:bg-gray-600 cursor-pointer px-2 pl-5"
                    x-on:click.prevent="showFormCreate">
                <span class="px-2 py-3">
                    {{ trans('plugins/blog::posts.create_tag') }}
                </span>
            </x-link>
            <x-link class="flex items-center hover:bg-blue-50 dark:hover:bg-gray-600 cursor-pointer px-2 pl-5"
                    href="{{ route('blog.tags.index') }}">
                <span class="px-2 py-3">
                    {{ trans('plugins/blog::posts.manage_tag') }}
                </span>
            </x-link>
        </x-slot>
    </x-plugins.blog::posts.input-search>
</div>
