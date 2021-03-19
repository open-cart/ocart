<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="image-cover hero-banner bg-no-repeat bg-cover bg-center"
         style="background-image:url(https://themezhub.net/resido-live/resido/assets/img/banner-1.jpg);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-20">
            <div class="hero-search-wrap bg-white max-w-xl p-10 pt-8 shadow-md">
                <div class="hero-search">
                    <div class="hero-search-wrap">
                        <div class="hero-search mb-4">
                            <h1 class="text-4xl font-extrabold capitalize">Find accessible homes to rent</h1>
                        </div>
                        <div class="hero-search-content side-form mb-4">

                            <div class="form-group mb-4">
                                <div class="input-with-icon relative">
                                    <x-theme::input type="text" class="pl-12" placeholder="Search for a location"/>
                                    <svg class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>

                        </div>
                        <div class="hero-search-action">
                            <a href="#" class="btn block text-xl text-white bg-blue-600 p-5 w-full text-center rounded-md">Search Result</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="sec-product antialiased bg-gray-100 text-gray-900 font-sans py-16">
        <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
            <h2 class="text-3xl font-bold">Explore Good places</h2>
            <p class="text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                praesentium voluptatum deleniti atque corrupti quos dolores</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-wrap -mx-4">
                @foreach(get_list_products() as $product)
                    <x-theme::item-product :data="$product"/>
                @endforeach
            </div>
        </div>

    </section>
    <section class="sec-post antialiased font-sans py-16">
        <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
            <h2 class="text-3xl font-bold">Find By Locations</h2>
            <p class="text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-wrap -mx-4">
                @foreach(get_list_products() as $post)
                    <x-theme::item-post :data="$post"/>
                @endforeach
            </div>
        </div>

    </section>
    <section class="antialiased font-sans bg-blue-600">
        <div class="call-to-act py-14 max-w-7xl mx-auto px-4 sm:px-6 block sm:flex items-center">
            <div class="call-to-act-head text-white flex-1 mb-8 sm:mb-0">
                <h3 class="text-2xl font-bold">Want to Become a Real Estate Agent?</h3>
                <span>We'll help you to grow your career and growth.</span>
            </div>
            <a href="#" class="btn btn-call-to-act bg-white border-4 border-blue-400 rounded-full py-4 px-8">SignUp Today</a>
        </div>
    </section>
</x-guest-layout>
