<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="image-cover hero-banner bg-no-repeat bg-cover bg-center"
         style="background-image:url(https://themezhub.net/resido-live/resido/assets/img/banner-1.jpg);">
        <div class="container-custom py-20">
            <div class="hero-search-wrap bg-white max-w-xl p-10 pt-8 shadow-md">
                <div class="hero-search">
                    <div class="hero-search-wrap">
                        <div class="hero-search mb-4">
                            <h1 class="text-4xl font-extrabold capitalize">Bạn cần tư vấn mua bất động sản?</h1>
                        </div>
                        <div class="hero-search-content side-form mb-4">

                            <div class="form-group mb-4">
                                <div class="input-with-icon relative">
                                    <x-theme::form.input type="text" class="pl-12" placeholder="Họ tên"/>
                                    <svg class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="input-with-icon relative">
                                    <x-theme::form.input type="text" class="pl-12" placeholder="Số điện thoại"/>
                                    <svg class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="input-with-icon relative">
                                    <x-theme::form.input type="text" class="pl-12" placeholder="Địa chỉ Email"/>
                                    <svg class="w-5 text-gray-400 absolute top-1/2 left-4 transform -translate-y-2/4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>

                        </div>
                        <div class="hero-search-action">
                            <a href="#" class="btn block text-xl text-white bg-blue-600 p-5 w-full text-center rounded-md">Gửi cho chúng tôi</a>
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

        <div class="container-custom">
            <div class="flex flex-wrap -mx-4">
                @foreach(get_list_products() as $product)
                    <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                        <x-theme::card.product :data="$product"/>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
    <section class="sec-post antialiased font-sans py-16">
        <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
            <h2 class="text-3xl font-bold">How It Works?</h2>
            <p class="text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
        </div>

        <div class="container-custom">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                    <div class="middle-icon-features-item text-center mt-4">
                        <div class="icon-features-wrap relative">
                            <div class="middle-icon-large-features-box f-light-success">
                                <svg class="inline-block text-green-500" width="30px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <div class="middle-icon-features-content pt-4">
                            <h4 class="text-xl mb-3 font-bold">Evaluate Property</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have Ipsum available.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                    <div class="middle-icon-features-item text-center mt-4">
                        <div class="icon-features-wrap relative">
                            <div class="middle-icon-large-features-box f-light-warning">
                                <svg class="inline-block text-yellow-500" width="30px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <div class="middle-icon-features-content pt-4">
                            <h4 class="text-xl mb-3 font-bold">Evaluate Property</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have Ipsum available.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                    <div class="middle-icon-features-item text-center mt-4">
                        <div class="icon-features-wrap relative remove">
                            <div class="middle-icon-large-features-box f-light-blue">
                                <svg class="inline-block text-blue-500" width="30px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <div class="middle-icon-features-content pt-4">
                            <h4 class="text-xl mb-3 font-bold">Evaluate Property</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have Ipsum available.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="sec-post antialiased bg-gray-100 font-sans py-16">
        <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
            <h2 class="text-3xl font-bold">Blog</h2>
            <p class="text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
        </div>

        <div class="container-custom">
            <div class="flex flex-wrap -mx-4">
                @foreach(get_list_posts() as $post)
                    <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                        <x-theme::card.post :data="$post"/>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
    <section class="antialiased font-sans bg-blue-600">
        <div class="container-custom call-to-act py-14 block sm:flex items-center">
            <div class="call-to-act-head text-white flex-1 mb-8 sm:mb-0">
                <h3 class="text-2xl font-bold">Want to Become a Real Estate Agent?</h3>
                <span>We'll help you to grow your career and growth.</span>
            </div>
            <a href="#" class="btn btn-call-to-act bg-white border-4 border-blue-400 rounded-full py-4 px-8">SignUp Today</a>
        </div>
    </section>
</x-guest-layout>
