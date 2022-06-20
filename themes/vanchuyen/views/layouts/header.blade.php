@php
    $logo = get_logo();
    $homepage = "/";
    $currentpage = $_SERVER['REQUEST_URI'];
    $menuMain = main_navigation();
    $menuMain = parent_recursive($menuMain->toArray());
@endphp
<header
    x-data="{ openMobile : false }"
    id="header"
    class="relative bg-white sticky top-0 z-40 shadow"
>
    <div class="container-custom">
        <div class="flex justify-end items-center py-2 lg:py-0 lg:space-x-8 h-14 lg:h-20">
            <div class="items-center flex-1">
                @if($currentpage == $homepage)
                    <h1 title="{!! get_title() !!}">
                        <a href="{!! route('home') !!}">
                            <img
                                class="h-12 sm:h-16 logo-header"
                                src="{{ $logo }}?w=300&h=300"
                                alt="{!! get_title() !!}"
                            >
                        </a>
                    </h1>
                @else
                    <a href="{!! route('home') !!}">
                        <img
                            class="h-12 sm:h-16 logo-header"
                            src="{{ $logo }}?w=300&h=300"
                            alt="{!! get_title() !!}"
                        >
                    </a>
                @endif
            </div>
            <div class="hidden lg:block items-center">
                <!-- Menu Main -->
                @if(!empty($menuMain))
                    <nav class="lg:flex space-x-6">
                        @foreach($menuMain as $item)
                            @php
                                $children = Arr::get($item, 'children');
                            @endphp
                            @if(!empty($children))
                                <div class="group py-7 inline-block relative">
                                    <a
                                        href="{{ Arr::get($item, 'url') }}"
                                        class="text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none"
                                        aria-expanded="false">
                                        {{ Arr::get($item, 'title') }}
                                        <x-theme::icons.chevron-down class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500"/>
                                    </a>

                                    <div
                                        class="absolute z-10 w-screen max-w-md lg:right-0 top-full absolute hidden group-hover:block"
                                    >
                                        <div
                                            class="shadow-lg ring-1 ring-black ring-opacity-5 max-h-screen overflow-hidden overflow-y-auto pb-12 bg-white py-4">
                                            @foreach($children as $i)
                                                @php
                                                    $subChildren = Arr::get($i, 'children');
                                                @endphp
                                                @if(!empty($subChildren))
                                                    <a href="{{ Arr::get($i, 'url') }}"
                                                       class="p-3 flex items-center justify-between hover:bg-gray-100">
                                                        {{ Arr::get($i, 'title') }}
                                                        <x-theme::icons.chevron-down class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500"/>
                                                    </a>
                                                    @foreach($subChildren as $subitemi)
                                                        <a href="{{ Arr::get($subitemi, 'url') }}"
                                                           class="p-3 flex items-center rounded-md hover:bg-gray-50"
                                                        >
                                                                <span
                                                                    class="ml-3 text-base font-medium text-gray-900">
                                                                - {{ Arr::get($subitemi, 'title') }}
                                                                </span>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <a href="{{ Arr::get($i, 'url') }}"
                                                       class="p-3 flex items-center justify-between hover:bg-gray-100">
                                                        {{ Arr::get($i, 'title') }}
                                                    </a>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ Arr::get($item, 'url') }}"
                                   class="text-base font-medium text-gray-500 hover:text-gray-900 py-7">
                                    {{ Arr::get($item, 'title') }}
                                </a>
                            @endif
                        @endforeach

                    </nav>
            @endif

            <!-- End Menu Main -->
            </div>

            <!-- Menu mobile -->
            <div class="-mr-2 -my-2 lg:hidden">
                <a
                    href="javascript:void(0)"
                    rel="nofollow"
                    class="relative z-20 mr-2 bg-white rounded-md inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none"
                    data-toggle="modal"
                    data-target="#search-modal"
                >
                    <x-theme::icons.search class="w-6"/>
                </a>

{{--                @if(is_active_plugin('ecommerce'))--}}
{{--                    <a href="{!! route(ROUTE_SHOPPING_CART_SCREEN_NAME) !!}"--}}
{{--                       class="relative z-20 mr-2 bg-white rounded-md inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">--}}
{{--                        <x-theme::icons.shopping-cart class="w-6"/>--}}
{{--                        <small id="cartcount"--}}
{{--                               class="cart-count absolute -top-1.5 -right-1.5 bg-blue-500 text-white w-4 h-4 text-xs inline-block text-center leading-4 rounded-full">{{ get_cart_count() }}</small>--}}
{{--                    </a>--}}
{{--                @endif--}}

                <button x-on:click="openMobile = !openMobile" type="button"
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none"
                        aria-expanded="false">
                    <span class="sr-only">Open menu</span>
                    <!-- Heroicon name: outline/menu -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <!-- End Menu mobile -->

            <!-- Login/Cart -->
            <div class="hidden lg:flex items-center">
                <a
                    href="javascript:void(0)"
                    rel="nofollow"
                    class="relative z-20 mr-6"
                    data-toggle="modal"
                    data-target="#search-modal"
                >
                    <x-theme::icons.search class="w-6"/>
                </a>

{{--                @if(is_active_plugin('ecommerce'))--}}
{{--                    <a href="{!! route(ROUTE_SHOPPING_CART_SCREEN_NAME) !!}" class="relative z-20 mr-8">--}}
{{--                        <x-theme::icons.shopping-cart class="w-6"/>--}}
{{--                        <small id="cartcount"--}}
{{--                               class="cart-count absolute -top-1.5 -right-1.5 bg-blue-500 text-white w-4 h-4 text-xs inline-block text-center leading-4 rounded-full">{{ get_cart_count() }}</small>--}}
{{--                    </a>--}}
{{--                @endif--}}

                @if(Auth::user())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div class="line-clamp-1" style="max-width: 120px">{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <x-theme::icons.chevron-down class="text-gray-400 h-4 w-4 group-hover:text-gray-500"/>

                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('user-profile')">
                                Thông tin tài khoản
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-dropdown-link>

                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a
                        href="javascript:void(0)"
                        rel="nofollow"
                        data-toggle="modal"
                        data-target="#form-login-modal"
                        class="whitespace-nowrap inline-flex px-2 py-1 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700"
                    >
                        Đăng nhập
                    </a>
                @endif

            </div>
            <!-- End Login/Cart -->

        </div>
    </div>

    <!-- Mobile menu, show/hide based on mobile menu state. -->
    <div
        x-show="openMobile"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-50"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-50"
        class="absolute top-0 inset-x-0 z-50"
        style="display:none;"
    >
        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50 h-screen">
            <div class="flex items-center justify-between px-4 pt-1">
                <div>
                    <img
                        class="h-12 logo-header"
                        src="{{ $logo }}?w=300&h=300"
                        alt="logo"
                    >
                </div>
                <div class="-mr-2">
                    <button
                        x-on:click="openMobile = !openMobile"
                        type="button"
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    >

                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="overflow-y-auto px-4 h-screen pb-4">
                @if(!empty($menuMain))
                    <div class="mt-4">
                        <nav>
                            @foreach($menuMain as $item)
                                @php
                                    $children = Arr::get($item, 'children');
                                @endphp
                                <div>
                                    @if(!empty($children))
                                        <div
                                            class="-m-3 px-3 py-2 rounded-md hover:bg-gray-50"
                                            x-data="{openNav: false}"
                                        >
                                            <div
                                                class="{{ !empty($children) ? 'flex items-center justify-between' : '' }}">
                                                <a
                                                    href="{{ Arr::get($item, 'url') }}"
                                                >
                                                    <span class="text-sm font-medium text-gray-900">
                                                        {{ Arr::get($item, 'title') }}
                                                    </span>
                                                </a>

                                                <div
                                                    x-on:click="openNav = ! openNav"
                                                    class="cursor-pointer w-16 md:w-20 h-8 text-lg flex-shrink-0 flex items-center justify-center -mr-4"
                                                >
                                                    <x-theme::icons.chevron-down class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500"/>

                                                </div>
                                            </div>
                                            @if(!empty($children))
                                                <nav
                                                    x-show="openNav"
                                                    class="ml-0 my-1"
                                                >
                                                    @foreach($children as $subitem)
                                                        @php
                                                            $subChildren = Arr::get($subitem, 'children');
                                                        @endphp
                                                        <div x-data="{openSubNav: false}">
                                                            @if(!empty($subChildren))
                                                                <div class="-m-3 px-3 py-2 rounded-md hover:bg-gray-50">
                                                                    <div
                                                                        @                                 class="{{ !empty($subChildren) ? 'flex items-center justify-between' : '' }}">
                                                                        <a
                                                                            href="{{ Arr::get($subitem, 'url') }}"
                                                                        >
                                                                    <span class="text-sm font-medium text-gray-900">
                                                                        - {{ Arr::get($subitem, 'title') }}
                                                                    </span>
                                                                        </a>

                                                                        <div
                                                                            x-on:click="openSubNav = ! openSubNav"
                                                                            class="cursor-pointer w-16 md:w-20 h-8 text-lg flex-shrink-0 flex items-center justify-center -mr-4"
                                                                        >
                                                                            <x-theme::icons.chevron-down class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500"/>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <a
                                                                    href="{{ Arr::get($subitem, 'url') }}"
                                                                    class="-m-3 px-3 py-2 flex items-center rounded-md hover:bg-gray-50"
                                                                >
                                                            <span
                                                                class="text-sm font-medium text-gray-900 h-8 leading-8">
                                                                - {{ Arr::get($subitem, 'title') }}
                                                            </span>
                                                                </a>
                                                            @endif
                                                            @if(!empty($subChildren))
                                                                <nav
                                                                    x-show="openSubNav"
                                                                    class="ml-0 my-1"
                                                                >
                                                                    @foreach($subChildren as $subitemi)
                                                                        <a
                                                                            href="{{ Arr::get($subitemi, 'url') }}"
                                                                            class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
                                                                            x-on:click="openMobile = !openMobile"
                                                                        >
                                                                    <span
                                                                        class="ml-3 text-sm font-medium text-gray-900">
                                                                    - {{ Arr::get($subitemi, 'title') }}
                                                                    </span>
                                                                        </a>
                                                                    @endforeach
                                                                </nav>
                                                            @endif
                                                        </div>

                                                    @endforeach
                                                </nav>
                                            @endif
                                        </div>
                                    @else
                                        <a
                                            x-on:click="openMobile = !openMobile"
                                            href="{{ Arr::get($item, 'url') }}"
                                            class="-m-3 px-3 py-2 flex items-center rounded-md hover:bg-gray-50"
                                        >
                                        <span class="text-sm font-medium text-gray-900 h-8 leading-8">
                                            {{ Arr::get($item, 'title') }}
                                        </span>
                                        </a>
                                    @endif

                                </div>
                            @endforeach

                        </nav>
                    </div>
                @endif
                <div class="py-4 space-y-2 text-sm mt-4 border-t">
                    @if(theme_options()->getOption('seo_description', null))
                        <p>{{ theme_options()->getOption('seo_description', null) }}</p>
                    @endif
                    @if(theme_options()->getOption('phone1', null))
                        <p>Hotline: {{ theme_options()->getOption('phone1', null) }}</p>
                    @endif
                    @if(theme_options()->getOption('address1', null))
                        <p>Địa chỉ 1: {{ theme_options()->getOption('address1', null) }}</p>
                    @endif
                    @if(theme_options()->getOption('address2', null))
                        <p>Địa chỉ 2: {{ theme_options()->getOption('address2', null) }}</p>
                    @endif
                </div>
                <div class="space-y-6 mb-12">
                    <div>
                        <a x-on:click="openMobile = !openMobile" href="{!! route('login') !!}"
                           class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                            Sign in
                        </a>
                        <p class="mt-6 text-center text-base font-medium text-gray-500">
                            Existing customer?
                            <a href="#" class="text-indigo-600 hover:text-indigo-500">
                                Sign up
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
