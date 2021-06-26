<div class="bg-white rounded" x-data="{open: false}">
    <div class="px-4 py-3 flex justify-between cursor-pointer" x-on:click="open = !open">
        <h3>{{ $name }}</h3>
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
         class="px-4 py-3 panel-group border-t">
        <div class="border px-3 py-2 mb-3">
            <ul>
                @foreach($list as $item)
                    <li class="menu-item-insert" data-type="{{ $type }}" data-item='@json($item)'>
                        <label class="flex items-center space-x-3">
                            <input class="rounded-md h-5 w-5 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   type="checkbox" value="{{ $item->id }}"/>
                            <span class="text-gray-900 font-medium dark:text-gray-300">{{ $item->name }}</span>
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