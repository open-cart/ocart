<div class="bg-white rounded border bg-gray-800 dark:border-gray-700" x-data="{open: false}">
    <div class="px-4 py-3 flex justify-between cursor-pointer" x-on:click="open = !open">
        <h3>{{ trans('packages/page::pages.menu') }}</h3>
        <span>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </span>
    </div>
    <div x-show="open"
         style="display: none"
         class="px-4 py-3 panel-group border-t dark:border-gray-700">
        @php
            $pages = app(\Ocart\Page\Repositories\PageRepository::class)->all()
        @endphp
        <div class="border dark:border-gray-700 px-3 py-2 mb-3">
            <ul>
                @foreach($pages as $page)
                    <li class="menu-item-insert" data-type="{{ \Ocart\Page\Models\Page::class }}" data-item='@json($page)'>
                        <label class="flex items-center space-x-3">
                            <input class="rounded-md h-5 w-5 border-gray-300 text-indigo-600 dark:border-gray-700 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   type="checkbox" value="{{ $page->id }}"/>
                            <span class="text-gray-900 font-medium dark:text-gray-300">{{ $page->name }}</span>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="flex justify-between">
            <div></div>
            <x-button type="button" class="btn-add-to-menu">
                {{ trans('packages/menu::menus.add_to_menu') }}
            </x-button>
        </div>
    </div>
</div>