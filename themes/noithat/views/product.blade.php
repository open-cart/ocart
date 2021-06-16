<x-guest-layout xmlns:x-theme="http://www.w3.org/1999/html">
    <div class="container-custom">
        <ol class="list-reset py-4 flex text-xs md:text-base text-grey">
            <li class="pr-2"><a href="{!! route('home') !!}" class="no-underline text-blue-600">Home</a></li>
            <li>/</li>
            @if(count($product->categories)>0)
            <li class="px-2 line-clamp-1"><a href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug' => Arr::get($product->categories->first(), 'slug')]) !!}" class="no-underline text-blue-600">{{ Arr::get($product->categories->first(), 'name') }}</a></li>
            <li>/</li>
            @endif
            <li class="px-2 line-clamp-1"><span class="no-underline text-gray-500">{{ $product->name }}</span></li>
        </ol>
    </div>
    <section x-data="imageData({{ $product }})" class="section-custom pt-0 product-library text-gray-700 body-font overflow-hidden bg-white">
        <div class="container-custom">
            <div class="lg:w-full mx-auto flex flex-wrap">
                <div class="lg:w-2/5 w-full ">
                    <div class="mb-4">
                        <img class="w-full h-full object-cover object-center rounded" x-bind:src="images.length ? '/storage/' + images[index] : '/no-images'" alt="ecommerce">
                    </div>
                    <div class="owl-carousel owl-theme mt-2 relative">
                        <template x-for="(item, i) in images" :key="i">
                            <div x-on:click="index = i" class="item">
                                <img x-bind:src="'/storage/' + item" alt="" class="w-full h-full object-cover">
                            </div>
                        </template>
                    </div>
                </div>
                <div class="lg:w-3/5 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    @if(count($product->categories)>0)
                    <h2 class="text-sm title-font text-gray-500">
                        <a href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug' => Arr::get($product->categories->first(), 'slug')]) !!}" class="hover:text-blue-700">{{ Arr::get($product->categories->first(), 'name') }}</a>
                    </h2>
                    @endif
                    <h1 class="text-gray-900 text-lg lg:text-2xl title-font font-medium mb-2">{{ $product->name }}</h1>
                    @if($product->address)
                        <div class="text-sm text-gray-500">
                            <span class="flex items-center">
                                <x-theme::icons.marker/> {{ $product->address }}
                            </span>
                        </div>
                    @endif
                    <div class="flex mb-4">
                        <a href="#comment-list" class="flex items-center">
                            <x-theme::icons.star class="text-yellow-500"/>
                            <x-theme::icons.star class="text-yellow-500"/>
                            <x-theme::icons.star class="text-yellow-500"/>
                            <x-theme::icons.star class="text-yellow-500"/>
                            <x-theme::icons.star class="text-gray-400"/>
                            <span class="text-gray-600 ml-3">4 Reviews</span>
                        </a>
                        <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                            <a class="text-gray-500 hover:text-blue-700" href="javascript:void(window.open('https://www.facebook.com/sharer.php?u=' + encodeURIComponent(document.location) + '?t=' + encodeURIComponent(document.title),'_blank'))">
                                <x-theme::icons.facebook/>
                            </a>
                            <a class="ml-2 text-gray-500 hover:text-blue-700" href="javascript:void(window.open('https://twitter.com/share?url=' + encodeURIComponent(document.location) + '&amp;text=' + encodeURIComponent(document.title) + '&amp;via=fabienb&amp;hashtags=koandesign','_blank'))">
                                <x-theme::icons.twitter/>
                            </a>
                        </span>
                    </div>
                    @if(!empty($product->description))
                        <div class="leading-relaxed text-sm md:text-base pt-4 border-t border-gray-200">{!! $product->description !!}</div>
                    @endif
                    <div class="mb-4 pt-4 border-t border-gray-200">
                        @if(!empty($product->sell_price) && $product->sell_price > 0)
                            <span class="title-font font-bold text-2xl text-red-600">{{ format_price($product->sell_price) }}đ</span>
                            @if($product->price > $product->sell_price)
                                <span class="title-font font-medium text-lg text-gray-300 line-through ml-4">{{ format_price($product->price) }}đ</span>
                            @endif
                        @else
                            <span class="title-font font-bold text-2xl text-red-600">Liên hệ</span>
                        @endif

                    </div>
                    <div class="flex items-center pt-4 border-t border-gray-200 my-4">
{{--                        <div class="flex mr-6">--}}
{{--                            <span class="mr-3">Color</span>--}}
{{--                            <button class="border-2 border-gray-300 rounded-full w-6 h-6 focus:outline-none"></button>--}}
{{--                            <button class="border-2 border-gray-300 ml-1 bg-gray-700 rounded-full w-6 h-6 focus:outline-none"></button>--}}
{{--                            <button class="border-2 border-gray-300 ml-1 bg-blue-600 rounded-full w-6 h-6 focus:outline-none"></button>--}}
{{--                        </div>--}}
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
                        <button onclick="addToCart({{ $product->id }})" class="flex text-white bg-blue-600 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Thêm vào giỏ</button>

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
            <div x-data="{selected:1}" id="comment-list" class="bg-white rounded-md mb-7">
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

            <div class="fb-comments mb-7" data-href="{!! route(ROUTE_PRODUCT_SCREEN_NAME, ['slug' => $product->slug]) !!}" data-width="100%" data-numposts="5" style="background: white;display: block;"></div>

            @if(count($product->categories)>0)
                <div>
                    <div class="text-left outline-none focus:outline-none font-bold mb-2 lg:mb-4">Sản phẩm liên quan</div>
                    <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                        @foreach(get_list_products_relate(Arr::get($product->categories->first(), 'id'), 6) as $product)
                        <div>
                                <x-theme::card.product :data="$product"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                @php
                    $products_feature = get_list_products_feature(8);
                @endphp
                <div class="text-left outline-none focus:outline-none font-bold my-2 lg:my-4">Sản phẩm bán chạy</div>
                <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-2 lg:gap-4">
                    @foreach($products_feature as $product)
                        <div>
                            <x-theme::card.product :data="$product"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                margin: 10,
                nav: true,
                items:5,
                dots:false,
            })
        });
        function imageData(data){
            return {
                images : data.images || [],
                index: 0,
            }
        }
    </script>
    <style>
        .product-library .owl-item:first-child{
            display: none !important;
        }
        .owl-carousel:not(.owl-loaded){
            opacity: 0;
            visibility:hidden;
        }
        .owl-carousel .owl-dots {
            position: absolute;
            bottom: 0px;
            width: 100%;
        }
        .owl-nav{
            font-size: 3rem;
        }
        .owl-prev:focus,
        .owl-next:focus{
            outline: none;
        }
        .owl-prev{
            position: absolute;
            top: calc(50% - 5px);
            left: 5px;
            transform: translateY(-50%);

        }
        .owl-next{
            position: absolute;
            top: calc(50% - 5px);
            right: 5px;
            transform: translateY(-50%);
        }
        .owl-prev span,
        .owl-next span{
            color: grey;
        }
        .owl-prev span:hover,
        .owl-next span:hover{
            color: black;
        }

        .owl-carousel button:hover, .owl-carousel button:focus, .owl-carousel button:focus-visible{
            outline: none;
            background: none !important;
        }
    </style>
</x-guest-layout>

