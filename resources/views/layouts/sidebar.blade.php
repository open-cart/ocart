<aside class="main-sidebar z-10" x-data="{open: false}">
    <div class="ml-2 mt-3 flex items-center lg:hidden"
        :class="{'hidden': open}">
        <button x-on:click="open = false"
                id="btn-close-sidebar"
                class="inline-flex items-center justify-center p-2 rounded-md
                    text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500
                    dark:text-gray-300 dark:hover:text-gray-300 dark:focus:text-gray-300 dark:hover:bg-gray-600 dark:focus:bg-gray-600
                    transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div x-on:click="open = ! open"
         :class="{'hidden': ! open}"
         class="bg-gray-300 fixed top-0 left-0 opacity-30 w-full h-full hidden" style="z-index:-1">
        &nbsp;
    </div>
    <div :class="{'hidden': ! open}" class="bg-white dark:bg-gray-800 shadow-md w-64 hidden lg:block">
        <div class="bg-red-600 border-b border-gray-100 dark:border-gray-700">
            <a href="{!! route('dashboard.index') !!}" class="h-16 flex items-center justify-center">
                <span class="text-white text-2xl dark:text-gray-300">Admin</span>
            </a>
        </div>
        <div class="h-1"></div>
        <ul id="sidebar-menu" style="overflow: auto; height: calc(100vh - 80px)">
            @foreach ($menus = dashboard_menu()->getAll() as $menu)
                <li class="nav-item border-b dark:border-gray-700 @if ($menu['active']) active @endif" id="{{ $menu['id'] }}">
                    <a :class="{[theme.bg]:true}" href="javascript:void(0)" class="px-3 py-3 block dark:bg-gray-900 flex justify-between">
                <span>
                    <i class="{{ $menu['icon'] }}"></i>
                    <span class="text-white">{{ trans($menu['name']) }} {!! apply_filters('BASE_FILTER_APPEND_MENU_NAME', null, $menu['id']) !!}</span>
                </span>
                        <span>
                    @if (isset($menu['children']) && count($menu['children']))
                                <i class="arrow fa fa-chevron-left transition duration-500 @if ($menu['active']) -rotate-90 transform @endif"></i>
                            @endif
                </span>
                    </a>
                    @if (isset($menu['children']) && count($menu['children']))
                        <ul class="sub-menu transition-all ease-in-out @if (!$menu['active']) hidden-ul @endif">
                            @foreach ($menu['children'] as $level1)
                                <li
                                        x-data="{ open: false }"
                                        class="nav-item border-b border-white dark:border-gray-800 @if ($level1['active']) bg-indigo-100 dark:bg-gray-700 @endif" id="{{ $level1['id'] }}">
                                    <a
                                            x-on:click="open = ! open"
                                            href="{{ isset($level1['children']) && count($level1['children']) ? 'javascript: void(0)' : $level1['url'] }}"
                                            class="pl-5 pr-3 py-3 cursor-pointer flex items-center hover:bg-gray-100 block dark:hover:bg-gray-700 dark:text-gray-300">
                                        <i class="{{ $level1['icon'] }}"></i>
                                        {{ $level1['name'] }}
                                    </a>
                                    @if (isset($level1['children']) && count($level1['children']))
                                        <ul
                                                x-show.transition.in.duration.200ms.out.duration.50ms="open"
                                                class="sub-menu @if (!$menu['active']) hidden-ul @endif">
                                            @foreach ($level1['children'] as $level2)
                                                <li class="nav-item @if ($level2['active']) active @endif" id="{{ $level2['id'] }}">
                                                    <a href="{{ $level2['url'] }}" class="pl-10 pr-3 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 block">
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
    </div>
</aside>
<style>
    .hidden-ul{
        opacity: 0;
        height: 0;
        overflow: hidden;
    }
</style>
<script>
    var theme = {{ session('theme', 'themes.blue') }};
    $("#sidebar-menu > li > ul a").click(function(){
        const _self = $(this);
        const li = $("#sidebar-menu li");

        li.removeClass('bg-indigo-100 dark:bg-gray-700');
        _self.closest('li').addClass('bg-indigo-100 dark:bg-gray-700');
        $("#btn-close-sidebar").click();
    })
    $("#sidebar-menu > li > a").click(function(){
        const _self = $(this);
        const li = $("#sidebar-menu li");
        const isActive = _self.closest('li').hasClass('active');

       let height = 0;
        _self.closest('li').find('ul').find('li').each(function(){
            height += this.clientHeight;
        })

        li.removeClass('active');
        li.find('ul').addClass('hidden-ul');
        li.find('ul').each(function(){
            this.style.height = 0;
        })
        li.find('.arrow').removeClass('-rotate-90 transform');

        if (!isActive) {
            _self.closest('li').addClass('active');
            _self.closest('li').find('ul').removeClass('hidden-ul');
            _self.closest('li').find('ul')[0].style.height = height + 'px';
            _self.closest('li').find('.arrow').addClass('-rotate-90 transform');
        }
    })
</script>
