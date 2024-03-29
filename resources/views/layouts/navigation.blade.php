<nav x-data="{ open: false }" class="lg:ml-64 bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
    <!-- Primary Navigation Menu -->
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
{{--                <div class="flex-shrink-0 flex items-center">--}}
{{--                    <a href="{{ route('dashboard') }}">--}}
{{--                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />--}}
{{--                    </a>--}}
{{--                </div>--}}

                <!-- Langguage -->
{{--                <div class="sm:flex sm:items-center sm:ml-6">--}}
{{--                    <x-dropdown align="right" width="48">--}}
{{--                        <x-slot name="trigger">--}}
{{--                            <button class="flex items-center text-sm font-medium--}}
{{--                             text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300--}}
{{--                             dark:text-gray-300 dark:hover:text-gray-400 dark:focus:text-gray-400--}}
{{--                             focus:outline-none transition duration-150 ease-in-out">--}}
{{--                                <div>Tiếng việt</div>--}}
{{--                                <div class="ml-1">--}}
{{--                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                    </svg>--}}
{{--                                </div>--}}
{{--                            </button>--}}
{{--                        </x-slot>--}}

{{--                        <x-slot name="content">--}}
{{--                            <x-dropdown-link :href="route('language::vi')">--}}
{{--                                Tiếng việt--}}
{{--                            </x-dropdown-link>--}}
{{--                            <x-dropdown-link :href="route('language::en')">--}}
{{--                                Tiếng anh--}}
{{--                            </x-dropdown-link>--}}
{{--                        </x-slot>--}}

{{--                    </x-dropdown>--}}
{{--                </div>--}}

                <!-- Settings themes -->
{{--                <div class="sm:flex sm:items-center sm:ml-6">--}}
{{--                    <x-dropdown align="right" width="48">--}}
{{--                        <x-slot name="trigger">--}}
{{--                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300--}}
{{--                             dark:text-gray-300 dark:hover:text-gray-400 dark:focus:text-gray-400--}}
{{--                             focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">--}}
{{--                                <div>Giao diện</div>--}}

{{--                                <div class="ml-1">--}}
{{--                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                    </svg>--}}
{{--                                </div>--}}
{{--                            </button>--}}
{{--                        </x-slot>--}}

{{--                        <x-slot name="content">--}}
{{--                            <x-dropdown-link :href="route('theme::blue')">--}}
{{--                                Blue--}}
{{--                            </x-dropdown-link>--}}
{{--                            <x-dropdown-link :href="route('theme::red')">--}}
{{--                                Red--}}
{{--                            </x-dropdown-link>--}}
{{--                            <x-dropdown-link :href="route('theme::green')">--}}
{{--                                Green--}}
{{--                            </x-dropdown-link>--}}
{{--                            <x-dropdown-link :href="route('theme::black')">--}}
{{--                                Dark--}}
{{--                            </x-dropdown-link>--}}
{{--                        </x-slot>--}}

{{--                    </x-dropdown>--}}
{{--                </div>--}}

                <!-- Navigation Links -->
{{--                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">--}}
{{--                    <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">--}}
{{--                        {{ __('Dashboard') }}--}}
{{--                    </x-nav-link>--}}
{{--                </div>--}}

                <!-- Navigation Links -->
{{--                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">--}}
{{--                    <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')">--}}
{{--                        {{ __('Dashboard') }}s--}}
{{--                    </x-nav-link>--}}
{{--                </div>--}}
            </div>

            <!-- Settings Dropdown -->
            <div class="flex space-x-4">
                <div class=" space-x-8 -my-px ml-10 flex">
                    <x-nav-link :href="route('home')" class="blank" target="_blank">
                        View website
                    </x-nav-link>
                </div>
                @if (Auth::check())
                    {!! apply_filters(BASE_FILTER_TOP_HEADER_LAYOUT, null) !!}
                @endif
                <div class=" flex items-center ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium
                            dark:text-gray-300 dark:hover:text-gray-400 dark:focus:text-gray-400
                             text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('admin.logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
{{--                <div class="-mr-2 flex items-center sm:hidden">--}}
{{--                    <button x-on:click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md--}}
{{--                    text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500--}}
{{--                    dark:text-gray-300 dark:hover:text-gray-300 dark:focus:text-gray-300 dark:hover:bg-gray-600 dark:focus:bg-gray-600--}}
{{--                    transition duration-150 ease-in-out">--}}
{{--                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">--}}
{{--                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />--}}
{{--                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>


</nav>
