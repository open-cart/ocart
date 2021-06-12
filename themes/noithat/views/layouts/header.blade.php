<!-- This example requires Tailwind CSS v2.0+ -->
<header x-data="{ openMobile : false }" id="header" class="relative bg-white sticky top-0 z-40">
    <div class="container-custom">
        <div class="flex justify-between items-center border-b-2 border-gray-100 py-2 lg:justify-start lg:space-x-10">
            <div class="flex justify-start lg:w-0 lg:flex-1">
                <a href="{!! route('home') !!}">
                    <span class="sr-only">Workflow</span>
                    @php
                        $logo = get_logo();
                    @endphp
                    <img class="h-8 w-auto sm:h-16" src="{{ $logo }}" alt="">
                </a>
            </div>

            <!-- Menu mobile -->
            <div class="-mr-2 -my-2 lg:hidden">

                @if(is_active_plugin('ecommerce'))
                    <a href="{!! route(ROUTE_SHOPPING_CART_SCREEN_NAME) !!}"
                       class="relative z-20 mr-2 bg-white rounded-md inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <x-theme::icons.shopping-cart class="w-6"/>
                        <small id="cartcount"
                               class="cart-count absolute -top-1.5 -right-1.5 bg-blue-500 text-white w-4 h-4 text-xs inline-block text-center leading-4 rounded-full">{{ get_cart_count() }}</small>
                    </a>
                @endif

                <button x-on:click="openMobile = !openMobile" type="button"
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
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

            <!-- Menu Main -->
            @php
                $menuMain = get_menu_main();
            @endphp

            @if(!empty($menuMain))
                <nav class="hidden lg:flex space-x-6">
                    @foreach($menuMain->data as $item)
                        @if(!empty($item->children))
                            <div class="group inline-block relative">
                                <button type="button"
                                        class="text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        aria-expanded="false">
                                    <span>{{ $item->name }}</span>
                                    <svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                </button>

                                <div
                                    class="absolute z-10 -ml-4 pt-3 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2 absolute hidden group-hover:block">
                                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                                        <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                            @foreach($item->children as $i)
                                                <a href="{{ $i->slug }}"
                                                   class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                                                    <!-- Heroicon name: outline/cursor-click -->
                                                    <svg class="flex-shrink-0 h-6 w-6 text-indigo-600"
                                                         xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                                    </svg>
                                                    <div class="ml-4">
                                                        <p class="text-base font-medium text-gray-900">
                                                            {{ $i->name }}
                                                        </p>
                                                        {{--                                                    <p class="mt-1 text-sm text-gray-500">--}}
                                                        {{--                                                        Speak directly to your customers in a more meaningful way.--}}
                                                        {{--                                                    </p>--}}
                                                    </div>
                                                </a>
                                                @if(!empty($i->children))
                                                    @foreach($i->children as $ii)
                                                        <a href="{{ $ii->slug }}"
                                                           class="ml-4 -m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                                                            <svg class="flex-shrink-0 h-6 w-6 text-indigo-600"
                                                                 xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor"
                                                                 aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                                            </svg>
                                                            <div class="ml-4">
                                                                <p class="text-base font-medium text-gray-900">
                                                                    {{ $ii->name }}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ $item->slug }}" class="text-base font-medium text-gray-500 hover:text-gray-900">
                                {{ $item->name }}
                            </a>
                        @endif
                    @endforeach

                </nav>
        @endif
        <!-- End Menu Main -->

            <!-- Login/Cart -->
            <div class="hidden lg:flex items-center justify-end lg:flex-1 lg:w-0">
                @if(is_active_plugin('ecommerce'))
                    <a href="{!! route(ROUTE_SHOPPING_CART_SCREEN_NAME) !!}" class="relative z-20 mr-8">
                        <x-theme::icons.shopping-cart class="w-6"/>
                        <small id="cartcount"
                               class="cart-count absolute -top-1.5 -right-1.5 bg-blue-500 text-white w-4 h-4 text-xs inline-block text-center leading-4 rounded-full">{{ get_cart_count() }}</small>
                    </a>
                @endif

                @if(Auth::user())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div class="w-16 line-clamp-1">{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
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
                    <a href="{!! route('login') !!}"
                       class="whitespace-nowrap inline-flex px-2 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             width="22px" class="mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Sign in
                    </a>
                @endif

            </div>
            <!-- End Login/Cart -->

        </div>
    </div>

    <!-- Mobile menu, show/hide based on mobile menu state. -->
    <div x-show="openMobile" class="absolute top-0 inset-x-0 transition transform origin-top-right z-50"
         style="display:none;">
        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50 h-screen overflow-y-auto">
            <div class="pt-5 pb-6 px-5">
                <div class="flex items-center justify-between">
                    <div>
                        <img class="h-8 w-auto" src="{{ $logo }}"
                             alt="Workflow">
                    </div>
                    <div class="-mr-2">
                        <button x-on:click="openMobile = !openMobile" type="button"
                                class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        {{--                            <span>Close menu</span>--}}
                        <!-- Heroicon name: outline/x -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @if(!empty($menuMain))
                    <div class="mt-6">
                        <nav>
                            @foreach($menuMain->data as $item)
                                <a href="{{ $item->slug }}"
                                   class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                    <!-- Heroicon name: outline/cursor-click -->
                                    <svg class="flex-shrink-0 h-6 w-6 text-indigo-600"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                    </svg>
                                    <span class="ml-3 text-base font-medium text-gray-900">
                                            {{ $item->name }}
                                        </span>
                                </a>
                                @if(!empty($item->children))
                                    <nav class="ml-6">
                                        @foreach($item->children as $subitem)
                                            <a href="{{ $subitem->slug }}"
                                               class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                                                <span class="ml-3 text-base font-medium text-gray-900">
                                            - {{ $subitem->name }}
                                            </span>
                                        @endforeach
                                    </nav>
                                @endif
                            @endforeach

                        </nav>
                    </div>
                @endif

            </div>
            <div class="py-6 px-5 space-y-6">
                <p>{{ get_deps() }}</p>
                <p>Hotline: {{ get_phone() }}</p>
                <p>Địa chỉ: {{ get_address() }}</p>
            </div>
            <div class="py-6 px-5 space-y-6">
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

</header>
