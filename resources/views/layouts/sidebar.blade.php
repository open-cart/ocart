<aside class="main-sidebar bg-white shadow-md w-64 hidden lg:block">
    <div class="bg-red-600 border-b border-gray-100">
        <div class="h-16 flex items-center justify-center">
            <span class="text-white text-2xl">Admin</span>
        </div>
    </div>
    <div class="h-1"></div>
    <ul style="overflow: auto; height: calc(100vh - 80px)">
    @foreach ($menus = dashboard_menu()->getAll() as $menu)
        <li class="nav-item @if ($menu['active']) active @endif" id="{{ $menu['id'] }}">
            <a :class="{[theme.bg]:true}" href="javascript:void(0)" class="px-3 py-3 block">
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
        <li style="height: 65px"></li>
    </ul>
</aside>
<script>
    var theme = {{ session('theme', 'themes.blue') }};
</script>
