<aside class="main-sidebar bg-white shadow-md w-64 hidden lg:block">
    <div class="bg-red-600 border-b border-gray-100">
        <div class="h-16 flex items-center justify-center">
            <span class="text-white text-2xl">Admin</span>
        </div>
    </div>
    <div class="h-1"></div>
    <ul>
    @foreach ($menus = dashboard_menu()->getAll() as $menu)
        <li class="nav-item @if ($menu['active']) active @endif" id="{{ $menu['id'] }}">
            <a :class="{[theme.bg]:true}" href="{{ $menu['url'] }}" class="px-3 py-3 block">
                <i class="{{ $menu['icon'] }}"></i>
                <span class="text-white">{{ trans($menu['name']) }} {!! apply_filters('BASE_FILTER_APPEND_MENU_NAME', null, $menu['id']) !!}</span>
                @if (isset($menu['children']) && count($menu['children'])) <span class="arrow @if ($menu['active']) open @endif"></span> @endif
            </a>
            @if (isset($menu['children']) && count($menu['children']))
                <ul class="sub-menu @if (!$menu['active']) hidden-ul @endif">
                    @foreach ($menu['children'] as $level1)
                        <li
                            x-data="{ open: false }"
                            class="nav-item @if ($level1['active']) bg-indigo-100 @endif" id="{{ $level1['id'] }}">
                            <a
                                x-on:click="open = ! open"
                                href="{{ isset($level1['children']) && count($level1['children']) ? 'javascript: void(0)' : $level1['url'] }}"
                                class="pl-5 pr-3 py-3 cursor-pointer flex items-center hover:bg-gray-100 block">
                                <i class="{{ $level1['icon'] }}"></i>
                                {{ trans($level1['name']) }}
                            </a>
                            @if (isset($level1['children']) && count($level1['children']))
                                <ul
                                    x-show.transition.in.duration.200ms.out.duration.50ms="open"
                                    class="sub-menu @if (!$menu['active']) hidden-ul @endif">
                                    @foreach ($level1['children'] as $level2)
                                        <li class="nav-item @if ($level2['active']) active @endif" id="{{ $level2['id'] }}">
                                            <a href="{{ $level2['url'] }}" class="pl-10 pr-3 py-3 hover:bg-gray-100 block">
                                                <i class="{{ $level2['icon'] }}"></i>
                                                {{ trans($level2['name']) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
    </ul>
{{--    @foreach($adminSidebar as $level1)--}}
{{--        <div :class="{[theme.bg]:true}" class="px-3 py-3">--}}
{{--            <span class="text-white flex items-center">--}}
{{--                {!! $level1->link->render() !!}--}}
{{--            </span>--}}
{{--        </div>--}}

{{--        @if($level1->hasChildren())--}}
{{--            @foreach ($level1->getChildren() as $level2)--}}
{{--                @if($level2->hasChildren())--}}
{{--                    <div x-data="{ open: false }">--}}
{{--                        <div--}}
{{--                            class="pl-5 pr-3 py-3 cursor-pointer flex items-center hover:bg-gray-100"--}}
{{--                            x-on:click="open = ! open"--}}
{{--                        >--}}
{{--                            {!! $level2->link->render() !!}--}}
{{--                            <svg :class="{'-rotate-180': open, 'rotate-0': ! open}" class="ml-auto fill-current h-4 w-4 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                            </svg>--}}
{{--                        </div>--}}
{{--                        <div--}}
{{--                            x-show.transition.in.duration.200ms.out.duration.50ms="open"--}}
{{--                            style="display: none;"--}}
{{--                            {!! $level2->link->parentAttributes() !!}>--}}
{{--                            @foreach ($level2->getChildren() as $level3)--}}
{{--                                <div :class="{'hover:bg-gray-100 {{ request()->routeIs($level3->link->routeName()) ? 'bg-indigo-100':'' }}': true}"--}}
{{--                                    {!! $level3->link->parentAttributes() !!}>--}}
{{--                                    {!! $level3->link->addClass('pl-10 pr-3 py-3')->render() !!}--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div--}}
{{--                        :class="{' hover:bg-gray-100 {{ request()->routeIs($level2->link->routeName()) ? 'bg-indigo-100':'' }}': true}"--}}
{{--                        {!! $level2->link->parentAttributes() !!}>--}}
{{--                        {!! $level2->link->addClass('pl-5 pr-3 py-3 cursor-pointer flex items-center')->render() !!}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    @endforeach--}}
</aside>
<script>
    var theme = {{ session('theme', 'themes.blue') }};
</script>
