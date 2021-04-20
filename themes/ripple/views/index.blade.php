<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="image-cover hero-banner bg-no-repeat bg-cover bg-center"
         style="background-image:url({!! Theme::asset('/images/banner-1.jpg') !!});">
        @if(is_active_plugin('contact'))
            <div class="container-custom py-20">
                <x-theme::form.contact id="contact-index" class="bg-white p-10 pt-8 shadow-md"/>
            </div>
        @endif

    </div>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
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
    @if(is_active_plugin('ecommerce'))
        <section class="sec-product antialiased bg-gray-100 text-gray-900 font-sans py-16">
            <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
                <h2 class="text-3xl font-bold">Explore Good places</h2>
                <p class="text-gray-600">Chúng tôi cho là xứng đáng với họ, và họ đang buộc tội những người ghét người công bình, Nhưng, sự thật,
                    và bị hư hỏng bởi những lời xu nịnh của hiện tại, và những nỗi đau này, thú vui đã xóa bỏ</p>
            </div>
            <div class="container-custom">
                @php
                    $products = get_list_products_feature(6);
                @endphp
                <div class="flex flex-wrap -mx-4">
                    @foreach($products as $product)
                        <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                            <x-theme::card.product :data="$product"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <section class="sec-testimonials py-16">
        <div class="max-w-6xl mx-auto px-8">
            <div class="relative" x-data="{ activeSlide: 1, slides:[1, 2] }">
                <div class="relative lg:flex rounded-lg shadow-2xl overflow-hidden" key="1" x-show="activeSlide === 1">
                    <div class="h-56 lg:h-auto lg:w-5/12 relative flex items-center justify-center">
                        <img class="absolute h-full w-full object-cover" src="https://danviet.mediacdn.vn/zoom/480_300/2021/1/26/cover-dv-16115958454521459392617.jpg" alt=""/>
                        <div class="absolute inset-0 bg-indigo-900 opacity-20"></div>
                    </div>
                    <div class="relative lg:w-7/12 bg-white">
                        <svg class="absolute h-full text-white w-24 -ml-12" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <polygon points="50,0 100,0 50,100 0,100"/>
                        </svg>
                        <div class="relative py-12 lg:py-24 px-8 lg:px-16 text-gray-700 leading-relaxed">
                            <p>
                                As <strong class="text-gray-900 font-medium">Slack</strong> grows rapidly, using Stripe helps them scale payments easily &mdash; supporting everything from getting paid by users around the world to enabling ACH payments for corporate customers.
                            </p>
                            <p class="mt-6">
                                <a href="#" class="font-medium text-blue-600 hover:text-red-900">Mai Thu Huyền nói gì về &rarr;</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="relative lg:flex rounded-lg shadow-2xl overflow-hidden" key="2" x-show="activeSlide === 2">
                    <div class="h-56 lg:h-auto lg:w-5/12 relative flex items-center justify-center">
                        <img class="absolute h-full w-full object-cover" src="https://list.vn/wp-content/uploads/2020/01/m%E1%BB%B9-t%C3%A2m.jpg" alt=""/>
                        <div class="absolute inset-0 bg-indigo-900 opacity-20"></div>
                    </div>
                    <div class="relative lg:w-7/12 bg-white">
                        <svg class="absolute h-full text-white w-24 -ml-12" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <polygon points="50,0 100,0 50,100 0,100"/>
                        </svg>
                        <div class="relative py-12 lg:py-24 px-8 lg:px-16 text-gray-700 leading-relaxed">
                            <p>
                                <strong class="text-gray-900 font-medium">Với</strong> khối lượng công việc triền miên ngày này qua ngày khác &mdash; thời gian nghỉ ngời thì ít, Diễn viên Danh Tùng đã lựa chọn Tinh nghệ mật ong collagen để sử dụng.
                            </p>
                            <p class="mt-6">
                                <a href="#" class="font-medium text-blue-600 hover:text-red-900">Ca sỹ Mỹ Tâm nói gì &rarr;</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 left-0 lg:flex lg:items-center">
                    <button class="mt-24 lg:mt-0 -ml-6 h-12 w-12 rounded-full bg-white p-3 shadow-lg focus:outline-none" x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                        <svg class="h-full w-full text-indigo-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/>
                        </svg>
                    </button>
                </div>
                <div class="absolute inset-y-0 right-0 lg:flex lg:items-center">
                    <button class="mt-24 lg:mt-0 -mr-6 h-12 w-12 rounded-full bg-white p-3 shadow-lg focus:outline-none" x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                        <svg class="h-full w-full text-indigo-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.59 13H3a1 1 0 0 1 0-2h15.59l-5.3-5.3a1 1 0 1 1 1.42-1.4l7 7a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.42-1.4l5.3-5.3z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @if(is_active_plugin('blog'))
        <section class="sec-post antialiased bg-gray-100 font-sans py-16">
            <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
                <h2 class="text-3xl font-bold">Blog</h2>
                <p class="text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
            </div>

            <div class="container-custom">
                @php
                    $posts = get_list_posts_feature(6);
                @endphp
                <div class="flex flex-wrap -mx-4">
                    @foreach($posts as $post)
                        <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/3 p-4">
                            <x-theme::card.post :data="$post"/>
                        </div>
                    @endforeach
                </div>
            </div>

        </section>
    @endif
    <section class="antialiased font-sans py-16">
        <div class="sec-heading text-center max-w-3xl mx-auto px-4 sm:px-6 mb-4">
            <h2 class="text-3xl font-bold">Đối tác</h2>
            <p class="text-gray-600">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
        </div>

        <div class="container-custom">
            <div class="flex flex-wrap">
                <div class="w-1/2 sm:w-1/2 xl:w-1/3 p-0.5">
                    <div class="bg-gray-100 p-2 sm:py-8 sm:px-0">
                        <img class="w-auto max-h-12 mx-auto" src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Lazada_%282019%29.svg" alt="">
                    </div>
                </div>
                <div class="w-1/2 sm:w-1/2 xl:w-1/3 p-0.5">
                    <div class="bg-gray-100 p-2 sm:py-8 sm:px-0">
                        <img class="w-auto max-h-12 mx-auto" src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Lazada_%282019%29.svg" alt="">
                    </div>
                </div>
                <div class="w-1/2 sm:w-1/2 xl:w-1/3 p-0.5">
                    <div class="bg-gray-100 p-2 sm:py-8 sm:px-0">
                        <img class="w-auto max-h-12 mx-auto" src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Lazada_%282019%29.svg" alt="">
                    </div>
                </div>
                <div class="w-1/2 sm:w-1/2 xl:w-1/3 p-0.5">
                    <div class="bg-gray-100 p-2 sm:py-8 sm:px-0">
                        <img class="w-auto max-h-12 mx-auto" src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Lazada_%282019%29.svg" alt="">
                    </div>
                </div>
                <div class="w-1/2 sm:w-1/2 xl:w-1/3 p-0.5">
                    <div class="bg-gray-100 p-2 sm:py-8 sm:px-0">
                        <img class="w-auto max-h-12 mx-auto" src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Lazada_%282019%29.svg" alt="">
                    </div>
                </div>
                <div class="w-1/2 sm:w-1/2 xl:w-1/3 p-0.5">
                    <div class="bg-gray-100 p-2 sm:py-8 sm:px-0">
                        <img class="w-auto max-h-12 mx-auto" src="https://upload.wikimedia.org/wikipedia/commons/4/4d/Lazada_%282019%29.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(is_active_plugin('distributor'))
        @include(Theme::getThemeNamespace('sections.distributor'))
    @endif

    @if(is_active_plugin('contact'))
        <section class="antialiased font-sans bg-blue-600">
            <div class="container-custom call-to-act py-14 block sm:flex items-center">
                <div class="call-to-act-head text-white flex-1 mb-8 sm:mb-0">
                    <h3 class="text-2xl font-bold">Want to Become a Real Estate Agent?</h3>
                    <span>We'll help you to grow your career and growth.</span>
                </div>
                <a href="javascript:void(0)"
                   data-toggle="modal"
                   data-target="#form-contact-modal"
                   class="btn btn-call-to-act bg-white border-4 border-blue-400 rounded-full py-4 px-8"
                >
                    SignUp Today
                </a>
            </div>
            <x-theme::form.contact-modal/>
        </section>
    @endif

</x-guest-layout>
