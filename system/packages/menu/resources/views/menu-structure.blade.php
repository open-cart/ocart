<div class="grid grid-cols-12 gap-4">
    <input type="hidden" name="deleted_nodes">
    <textarea name="menu_nodes" class="hidden" id="nestable-output"></textarea>
    <div class="hidden" id="nestable-input" data-input='@json($menu_nodes)'></div>

    <div class="col-span-4 space-y-4">
        @php do_action(MENU_ACTION_SIDEBAR_OPTIONS) @endphp

        <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded" x-data="{open: false}">
            <div class="px-4 py-3 flex justify-between cursor-pointer" x-on:click="open = !open">
                <h3>{{ trans('packages/menu::menus.add_link') }}</h3>
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
                 id="external_link"
                 class="px-4 py-3 panel-group border-t dark:border-gray-700">
                <div class="space-y-4 mb-3">
                    <label class="block ">
                        <span>{{ trans('packages/menu::menus.title') }}</span>
                        <x-input id="node-title" name="title" class="w-full"/>
                    </label>
                    <label class="block">
                        <span>{{ trans('packages/menu::menus.url') }}</span>
                        <x-input id="node-url" name="url" class="w-full"/>
                    </label>
                </div>
                <div class="flex justify-between">
                    <div></div>
                    <x-button type="button" class="btn-add-to-menu">
                        {{ trans('packages/menu::menus.add_to_menu') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-8 space-y-4">
        <div class="bg-white dark:bg-gray-800 border border-white dark:border-gray-700 rounded">
            <h3 class=" px-4 py-3">{{ trans('Menu structure') }}</h3>
            <hr class="dark:border-gray-700">
            <div class="nestable-menu p-4">
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                    </ol>
                </div>
            </div>
            <hr class="dark:border-gray-700">
            <h3 class="text-2xl py-3 px-4">{{ trans('packages/menu::menus.menu_settings') }}</h3>
            <div class="flex px-4">
                <div class="flex-none w-40">
                    <span>{{ trans('packages/menu::menus.display_location') }}</span>
                </div>
                <div class="flex-grow space-y-3">
                    <label class="flex items-center space-x-3">
                        <input type="checkbox"
                               name="navigation[]"
                               @if(setting('header_navigation') == $menu->id) checked @endif
                               value="header_navigation"
                               class="rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="text-gray-900 font-medium dark:text-gray-300">
                            {{ trans('packages/menu::menus.header_navigation') }}
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox"
                               name="navigation[]"
                               @if(setting('main_navigation') == $menu->id) checked @endif
                               value="main_navigation"
                               class="rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="text-gray-900 font-medium dark:text-gray-300">
                            {{ trans('packages/menu::menus.main_navigation') }}
                        </span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="checkbox"
                               name="navigation[]"
                               @if(setting('footer_navigation') == $menu->id) checked @endif
                               value="footer_navigation"
                               class="rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="text-gray-900 font-medium dark:text-gray-300">
                            {{ trans('packages/menu::menus.footer_navigation') }}
                        </span>
                    </label>
                </div>
            </div>
            <div class="pb-6"></div>
        </div>
    </div>
</div>