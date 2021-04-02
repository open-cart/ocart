<x-guest-layout>
    <div class="container-custom">
        <ol class="list-reset py-4 flex text-grey">
            <li class="pr-2"><a href="{!! route('home') !!}" class="no-underline text-red-500">Home</a></li>
            <li>/</li>
            <li class="px-2"><a href="/product-category/{{ Arr::get($product->categories->first(), 'id') }}" class="no-underline text-red-500">{{ Arr::get($product->categories->first(), 'name') }}</a></li>
            <li>/</li>
            <li class="px-2"><span class="no-underline text-gray-500">{{ $product->name }}</span></li>
        </ol>
    </div>
    <section class="pb-12 text-gray-700 body-font overflow-hidden bg-white">
        <div class="container-custom">
            <div class="lg:w-full mx-auto flex flex-wrap">
                <img class="lg:w-1/2 w-full object-cover object-center rounded" src="{{ TnMedia::url(head($product->images)) }}" alt="ecommerce">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500">
                        <a href="/product-category/{{ Arr::get($product->categories->first(), 'id') }}">{{ Arr::get($product->categories->first(), 'name') }}</a>
                    </h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-2">{{ $product->name }}</h1>
                    @if($product->address)
                        <div class="text-sm text-gray-500">
                            <span class="flex items-center">
                                <x-theme::icons.marker/> {{ $product->address }}
                            </span>
                        </div>
                    @endif
                    <div class="flex mb-4">
                        <a href="#" class="flex items-center">
                            <x-theme::icons.star class="text-yellow-500"/>
                            <x-theme::icons.star class="text-yellow-500"/>
                            <x-theme::icons.star class="text-yellow-500"/>
                            <x-theme::icons.star class="text-yellow-500"/>
                            <x-theme::icons.star class="text-gray-400"/>
                            <span class="text-gray-600 ml-3">4 Reviews</span>
                        </a>
                        <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                            <a class="text-gray-500" href="javascript:void(window.open('https://www.facebook.com/sharer.php?u=' + encodeURIComponent(document.location) + '?t=' + encodeURIComponent(document.title),'_blank'))">
                                <x-theme::icons.facebook/>
                            </a>
                            <a class="ml-2 text-gray-500" href="javascript:void(window.open('https://twitter.com/share?url=' + encodeURIComponent(document.location) + '&amp;text=' + encodeURIComponent(document.title) + '&amp;via=fabienb&amp;hashtags=koandesign','_blank'))">
                                <x-theme::icons.twitter/>
                            </a>
                        </span>
                    </div>
                    <div class="mb-4 pt-4 border-t border-gray-200">
                        @if($product->price >= 1)
                            <span class="title-font font-medium text-2xl text-gray-900">{{ $product->price }}đ</span>
                        @else
                            <span class="title-font font-medium text-2xl text-gray-900">Liên hệ</span>
                        @endif
                        @if($product->price >= 1 && $product->price < $product->price_sell)
                            <span class="title-font font-medium text-lg text-gray-300 line-through ml-4">{{ $product->price_sell }}đ</span>
                        @endif
                    </div>
                    <div class="leading-relaxed pt-4 border-t border-gray-200">{!! $product->description !!}</div>
                    <div class="flex items-center pt-4 border-t border-gray-200 my-4">
                        <div class="flex mr-6">
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
                    <div class="flex pt-4 border-t border-gray-200 ">
                        <button class="flex text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-500 rounded">Thêm vào giỏ</button>
                        <button class="ml-auto rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
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
        <div class="container-custom py-12 justify-center">
            <div class="bg-white rounded-md mb-7" x-data="{selected:1}">
                <ul class="shadow-box">

                    <li class="relative">

                        <button type="button" class="w-full px-6 py-4 text-left outline-none focus:outline-none" x-on:click="selected !== 1 ? selected = 1 : selected = null">
                            <div class="flex items-center justify-between">
                                <span class="font-bold">Nội dung chi tiết</span>
                                <x-theme::icons.chevron-down/>
                            </div>
                        </button>

                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                            <div class="px-6 pb-4">
                                {!! $product->content !!}
                            </div>
                        </div>

                    </li>

                </ul>
            </div>

            <div class="bg-white rounded-md mb-7" x-data="{selected:1}">
                <ul class="shadow-box">

                    <li class="relative">

                        <button type="button" class="w-full px-6 py-4 text-left outline-none focus:outline-none" x-on:click="selected !== 1 ? selected = 1 : selected = null">
                            <div class="flex items-center justify-between">
                                <span class="font-bold">Bình Luận</span>
                                <x-theme::icons.chevron-down/>
                            </div>
                        </button>

                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                            <div class="px-6 pb-4">
                                <ul>
                                    <li class="mb-5 border-b border-dotted">
                                        <div class="pb-6">
                                            <div class="float-left w-16">
                                                <img src="https://themezhub.net/resido-live/resido/assets/img/user-1.jpg" alt="" class="rounded-full m-w-16">
                                            </div>
                                            <div class="pl-6 flex flex-wrap">
                                                <div class="comment-meta">
                                                    <div class="comment-left-meta">
                                                        <h4 class="font-2xl font-bold">Rosalina Kelian</h4>
                                                        <div class="mt-1 text-green-500">19th May 2018</div>
                                                    </div>
                                                </div>
                                                <div class="mt-4 text-gray-500">
                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim laborumab.
                                                        perspiciatis unde omnis iste natus error
                                                        perspiciatis unde omnis iste natus error.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-5">
                                        <div class="pb-6">
                                            <div class="float-left w-16">
                                                <img src="https://themezhub.net/resido-live/resido/assets/img/user-1.jpg" alt="" class="rounded-full m-w-16">
                                            </div>
                                            <div class="pl-6 flex flex-wrap">
                                                <div class="comment-meta">
                                                    <div class="comment-left-meta">
                                                        <h4 class="font-2xl font-bold">Rosalina Kelian</h4>
                                                        <div class="mt-1 text-green-500">19th May 2018</div>
                                                    </div>
                                                </div>
                                                <div class="mt-4 text-gray-500">
                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim laborumab.
                                                        perspiciatis unde omnis iste natus error
                                                        perspiciatis unde omnis iste natus error.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </li>

                </ul>
            </div>

            <div x-data="{selected:1}" class="bg-white rounded-md">
                <ul class="shadow-box">

                    <li class="relative">

                        <button x-on:click="selected !== 1 ? selected = 1 : selected = null" type="button" class="w-full px-6 py-4 text-left outline-none focus:outline-none">
                            <div class="flex items-center justify-between">
                                <span class="font-bold">Viết Bình Luận</span>
                                <x-theme::icons.chevron-down/>
                            </div>
                        </button>

                        <div x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''" class="relative overflow-hidden transition-all max-h-0 duration-700">
                            <div class="px-6 pb-4">
                                <form>
                                    <textarea class="p-3 bg-indigo-50 w-full rounded-md outline-none" placeholder="Viết bình luận..." rows="5"></textarea>
                                    <div class="my-2">
                                        <button class="flex text-white bg-green-500 border-0 py-4 px-6 focus:outline-none hover:bg-green-700 rounded" type="submit">Submit Review</button>
                                    </div>
                                </form>
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
                <div x-show="activeSlide === slide" class="p-24 font-bold text-5xl h-64 flex items-center bg-red-500 text-white rounded-lg">
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
                            class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-red-500 hover:shadow-lg"
                            :class="{
              'bg-red-500': activeSlide === slide,
              'bg-red-300': activeSlide !== slide
          }"
                            x-on:click="activeSlide = slide"
                    ></button>
                </template>
            </div>
        </div>

    </div>

</x-guest-layout>
