<x-guest-layout>
    <ol class="max-w-7xl mx-auto px-4 sm:px-6 list-reset py-4 pl-4 flex text-grey">
        <li class="px-2"><a href="/" class="no-underline text-indigo">Home</a></li>
        <li>/</li>
        <li class="px-2"><a href="/product/{{$product->id}}" class="no-underline text-indigo">{{ $product->name }}</a></li>
    </ol>

    <section class="pb-12 text-gray-700 body-font overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 ">
            <div class="lg:w-full mx-auto flex flex-wrap">
                <img class="lg:w-1/2 w-full object-cover object-center rounded" src="https://graph.noithattruongyen.vn/images/1650c3c4-3b03-4d36-a057-f974128c0e3b-n%E1%BB%99i%20th%E1%BA%A5t%20th%C3%B4ng%20minh%20(3).png" alt="ecommerce">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500">{{ $product->name }}</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
                    <div class="flex mb-4">
          <span class="flex items-center">
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            <span class="text-gray-600 ml-3">4 Reviews</span>
          </span>
                        <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                            <a class="text-gray-500">
                              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                              </svg>
                            </a>
                            <a class="ml-2 text-gray-500">
                              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                              </svg>
                            </a>
                            <a class="ml-2 text-gray-500">
                              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                              </svg>
                            </a>
                        </span>
                    </div>
                    <p class="leading-relaxed">{{ $product->description }}</p>
                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                        <div class="flex mr-6 hidden">
                            <span class="mr-3">Color</span>
                            <button class="border-2 border-gray-300 rounded-full w-6 h-6 focus:outline-none"></button>
                            <button class="border-2 border-gray-300 ml-1 bg-gray-700 rounded-full w-6 h-6 focus:outline-none"></button>
                            <button class="border-2 border-gray-300 ml-1 bg-red-500 rounded-full w-6 h-6 focus:outline-none"></button>
                        </div>
                        <div class="flex items-center hidden">
                            <span class="mr-3">Size</span>
                            <div class="relative">
                                <select class="rounded appearance-none bg-blue-50 py-2 focus:outline-none text-base pl-3 pr-10">
                                    <option>SM</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                </select>
                                <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                  <path d="M6 9l6 6 6-6"></path>
                </svg>
              </span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">Số lượng</span>
                            <div class="relative">
                                <input class="rounded appearance-none bg-blue-50 py-2 focus:outline-none text-base px-3 w-20" type="number" value="1"/>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        @if($product->price >= 1)
                            <span class="title-font font-medium text-2xl text-gray-900">{{ $product->price }}đ</span>
                        @else
                            <span class="title-font font-medium text-2xl text-gray-900">Liên hệ</span>
                        @endif
                        @if($product->price >= 1 && $product->price < $product->price_sell)
                            <span class="title-font font-medium text-lg text-gray-300 line-through ml-4">{{ $product->price_sell }}đ</span>
                        @endif
                        <button class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Thêm vào giỏ</button>
                        <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 justify-center">
            <div class="bg-white rounded-md mb-7" x-data="{selected:1}">
                <ul class="shadow-box">

                    <li class="relative">

                        <button type="button" class="w-full px-6 py-4 text-left outline-none focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
                            <div class="flex items-center justify-between">
                                <span class="font-bold">Nội dung chi tiết</span>
                                <svg class="h-6 w-6 bg-blue-50 p-1 rounded-full font-bold" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                            <div class="px-6 pb-4">
                                {{ $product->content }}
                            </div>
                        </div>

                    </li>

                </ul>
            </div>

            <div class="bg-white rounded-md mb-7" x-data="{selected:null}">
                <ul class="shadow-box">

                    <li class="relative">

                        <button type="button" class="w-full px-6 py-4 text-left outline-none focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
                            <div class="flex items-center justify-between">
                                <span class="font-bold">Bình Luận</span>
                                <svg class="h-6 w-6 bg-blue-50 p-1 rounded-full font-bold" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                            <div class="px-6 pb-4">
                                <p>reCAPTCHA v2 is not going away! We will continue to fully support and improve security and usability for v2.</p>
                                <p>reCAPTCHA v3 is intended for power users, site owners that want more data about their traffic, and for use cases in which it is not appropriate to show a challenge to the user.</p>
                                <p>For example, a registration page might still use reCAPTCHA v2 for a higher-friction challenge, whereas more common actions like sign-in, searches, comments, or voting might use reCAPTCHA v3. To see more details, see the reCAPTCHA v3 developer guide.</p>
                            </div>
                        </div>

                    </li>

                </ul>
            </div>

            <div class="bg-white rounded-md" x-data="{selected:null}">
                <ul class="shadow-box">

                    <li class="relative">

                        <button type="button" class="w-full px-6 py-4 text-left outline-none focus:outline-none" @click="selected !== 1 ? selected = 1 : selected = null">
                            <div class="flex items-center justify-between">
                                <span class="font-bold">Viết Bình Luận</span>
                                <svg class="h-6 w-6 bg-blue-50 p-1 rounded-full font-bold" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                            <div class="px-6 pb-4">
                                <p>reCAPTCHA v2 is not going away! We will continue to fully support and improve security and usability for v2.</p>
                                <p>reCAPTCHA v3 is intended for power users, site owners that want more data about their traffic, and for use cases in which it is not appropriate to show a challenge to the user.</p>
                                <p>For example, a registration page might still use reCAPTCHA v2 for a higher-friction challenge, whereas more common actions like sign-in, searches, comments, or voting might use reCAPTCHA v3. To see more details, see the reCAPTCHA v3 developer guide.</p>
                            </div>
                        </div>

                    </li>

                </ul>
            </div>

        </div>
    </div>


    <div class="bg-red-100 h-screen flex flex-col justify-center items-center hidden">

        <div
                class="max-w-4xl mx-auto relative"
                x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5] }"
        >
            <!-- Slides -->
            <template x-for="slide in slides" :key="slide">
                <div
                        x-show="activeSlide === slide"
                        class="p-24 font-bold text-5xl h-64 flex items-center bg-red-500 text-white rounded-lg">
                    <span class="w-12 text-center" x-text="slide"></span>
                    <span class="text-red-300">/</span>
                    <span class="w-12 text-center" x-text="slides.length"></span>
                </div>
            </template>

            <!-- Prev/Next Arrows -->
            <div class="absolute inset-0 flex">
                <div class="flex items-center justify-start w-1/2">
                    <button
                            class="bg-red-100 text-red-500 hover:text-orange-500 font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6"
                            x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                        &#8592;
                    </button>
                </div>
                <div class="flex items-center justify-end w-1/2">
                    <button
                            class="bg-red-100 text-red-500 hover:text-orange-500 font-bold hover:shadow rounded-full w-12 h-12 -mr-6"
                            x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                        &#8594;
                    </button>
                </div>
            </div>

            <!-- Buttons -->
            <div class="absolute w-full flex items-center justify-center px-4">
                <template x-for="slide in slides" :key="slide">
                    <button
                            class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-red-600 hover:shadow-lg"
                            :class="{
              'bg-blue-600': activeSlide === slide,
              'bg-red-300': activeSlide !== slide
          }"
                            x-on:click="activeSlide = slide"
                    ></button>
                </template>
            </div>
        </div>

    </div>

</x-guest-layout>
