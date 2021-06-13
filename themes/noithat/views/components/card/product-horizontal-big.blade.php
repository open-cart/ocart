@props(['data' => null])
@if($data)
    <div class="h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-64 md:pb-80 overflow-hidden">
            <a href="{!! route(ROUTE_PRODUCT_SCREEN_NAME, ['slug' => $data->slug]) !!}">
                <img class="absolute inset-0 h-full w-full object-cover" src="{{ TnMedia::url(empty($data->images) ? asset('/images/no-image.jpg') : head($data->images)) }}" alt="">
            </a>
            <div class="absolute bottom-0 right-0 top-0 bg-white bg-opacity-80 w-1/3 p-2 md:p-3">
                @if(count($data->categories)>0)
                    <div class="hidden md:inline-block">
                        <div class="line-clamp-2">
                            @foreach($data->categories as $key=>$item)
                                <a href="{!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug' => $item->slug]) !!}" class="leading-none text-gray-500 tracking-wide text-xs hover:text-blue-700" >
                                    {{ $item->name }}
                                </a>
                                @if(count($data->categories) != $key + 1)
                                    <span>, </span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                <a href="{!! route(ROUTE_PRODUCT_SCREEN_NAME, ['slug' => $data->slug]) !!}" class="hover:text-blue-700">
                    <h3 class="text-xs md:text-base font-semibold text-gray-700 line-clamp-4">{{ $data->name }}</h3>
                </a>
                {{--            <div class="hidden md:block text-sm text-gray-500 md:line-clamp-3">{!! $data->description !!}</div>--}}
                <div class="flex justify-between items-center md:mt-2">
                    @if(!empty($data->sell_price) && $data->sell_price > 0)
                        <div class="flex text-red-600">
                            <span class="font-bold text-sm md:text-base">{{ format_price($data->sell_price) }}</span>
                            &nbsp;
                            <span class="text-sm font-semibold">đ</span>
                        </div>
                    @else
                        <div class="flex text-red-600">
                            <span class="font-bold text-sm md:text-base">Liên hệ</span>
                        </div>
                    @endif

                    <button onclick="addToCart({{ $data->id }})" class="hidden md:block flex text-blue-600 p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:text-green-500" title="Thêm vào giỏ hàng">
                        <x-theme::icons.shopping-cart class="w-7"/>
                    </button>

                </div>
            </div>
        </div>

    </div>

@endif
