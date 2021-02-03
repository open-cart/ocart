<aside class="main-sidebar bg-white shadow-md w-64 hidden lg:block">
    <div class="bg-red-600 border-b border-gray-100">
        <div class="h-16 flex items-center justify-center">
            <span class="text-white text-2xl">Admin</span>
        </div>
    </div>
    <div class="h-1"></div>
    @foreach($adminSidebar as $level1)
        <div :class="{[theme.bg]:true}" class="px-3 py-3">
            <span class="text-white flex items-center">
                {!! $level1->link->render() !!}
            </span>
        </div>

        @if($level1->hasChildren())
            @foreach ($level1->getChildren() as $level2)
                @if($level2->hasChildren())
                    <div x-data="{ open: false }">
                        <div
                            class="pl-5 pr-3 py-3 cursor-pointer flex items-center hover:bg-gray-100"
                            @click="open = ! open"
                        >
                            {!! $level2->link->render() !!}
                            <svg :class="{'-rotate-180': open, 'rotate-0': ! open}" class="ml-auto fill-current h-4 w-4 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div
                            x-show.transition.in.duration.200ms.out.duration.50ms="open"
                            {!! $level2->link->parentAttributes() !!}>
                            @foreach ($level2->getChildren() as $level3)
                                <div :class="{'hover:bg-gray-100 {{ request()->routeIs($level3->link->routeName()) ? 'bg-indigo-100':'' }}': true}"
                                    {!! $level3->link->parentAttributes() !!}>
                                    {!! $level3->link->addClass('pl-10 pr-3 py-3')->render() !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div
                        :class="{' hover:bg-gray-100 {{ request()->routeIs($level2->link->routeName()) ? 'bg-indigo-100':'' }}': true}"
                        {!! $level2->link->parentAttributes() !!}>
                        {!! $level2->link->addClass('pl-5 pr-3 py-3 cursor-pointer flex items-center')->render() !!}
                    </div>
                @endif
            @endforeach
        @endif
    @endforeach
</aside>
