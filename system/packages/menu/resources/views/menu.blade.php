@if($list)
    <ul class="space-y-3 @if ($children == true) pl-6 @endif">
        @foreach($list as $item)
            <li class="menu-item-insert" data-type="{{ $type }}" data-item='@json($item)'>
                <label class="flex items-center space-x-3">
                    <input class="rounded-md h-5 w-5 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           type="checkbox" value="{{ $item->id }}"/>
                    <span class="text-gray-900 font-medium dark:text-gray-300">{{ $item->name }}</span>
                </label>
                @php
                    echo \Ocart\Menu\Facades\Menu::generateSelect([
                        'list' => $item->child_cats,
                        'type' => $type,
                        'children' => true
                    ])
                @endphp
            </li>
        @endforeach
    </ul>
@endif
