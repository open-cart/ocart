@props(['data' => null])
@if($data)
    <div class="h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-32 md:pb-44 overflow-hidden">
            <a href="{!! route(ROUTE_PRODUCT_SCREEN_NAME, ['slug' => $data->slug]) !!}">
                <img class="absolute inset-0 h-full w-full object-cover" src="{{ TnMedia::url(empty($data->images) ? asset('/images/no-image.jpg') : head($data->images)) }}" alt="">
            </a>
        </div>
        <div class="p-2 md:p-3">
            @if(count($data->categories)>0)
                <a href={!! route(ROUTE_PRODUCT_CATEGORY_SCREEN_NAME, ['slug' => Arr::get($data->categories->first(), 'slug')]) !!} class="hidden md:inline-block leading-none text-gray-500 tracking-wide text-xs hover:text-blue-700">
                {{ Arr::get($data->categories->first(), 'name') }}
                </a>
            @endif
            <a href="{!! route(ROUTE_PRODUCT_SCREEN_NAME, ['slug' => $data->slug]) !!}" class="hover:text-blue-700">
                <h3 class="text-xs md:text-base font-bold line-clamp-2">{{ $data->name }}</h3>
            </a>
{{--            <div class="hidden md:block text-sm text-gray-500 md:line-clamp-3">{!! $data->description !!}</div>--}}
            <div class="flex justify-between items-center md:mt-2">
                <div class="flex text-red-600">
                    <span class="font-bold text-sm md:text-base">{{ format_price($data->sell_price) }}</span>
                    &nbsp;
                    <span class="text-sm font-semibold">đ</span>
                    @if($data->price > $data->sell_price)
                        <span class="hidden md:block font-medium line-through text-gray-300 text-sm ml-2">{{ format_price($data->price) }}</span>
                        &nbsp;
                        <span class="hidden md:block text-xs font-semibold text-gray-300 line-through">đ</span>
                    @endif
                </div>
                <button onclick="addToCart({{ $data->id }})" class="hidden md:block flex text-blue-600 p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:text-green-500" title="Thêm vào giỏ hàng">
                    <x-theme::icons.shopping-cart class="w-7"/>
                </button>

            </div>
        </div>
        @if(is_active_plugin('eclocation'))
            @if($data->address)
                <div class="p-2 md:p-4 border-t text-xs md:text-sm text-gray-500">
                <span class="flex items-center">
                    <x-theme::icons.marker class="hidden md:block"/> {{ $data->address }}
                </span>
                </div>
            @endif
        @endif

{{--        <div class="hidden md:flex justify-between p-4 border-t items-center text-sm text-gray-600">--}}
{{--            <div class="flex">--}}
{{--                <x-theme::icons.star class="text-yellow-500"/>--}}
{{--                <x-theme::icons.star class="text-yellow-500"/>--}}
{{--                <x-theme::icons.star class="text-yellow-500"/>--}}
{{--                <x-theme::icons.star class="text-yellow-500"/>--}}
{{--                <x-theme::icons.star class="text-gray-400"/>--}}
{{--                <span class="ml-1">(34)</span>--}}
{{--            </div>--}}
{{--            @if($data->created_at)--}}
{{--                <div class="flex">--}}
{{--                    <x-theme::icons.calendar/>--}}
{{--                    <span class="ml-1">{{ date_format($data->created_at, "d/m/Y") }}</span>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
    </div>

@endif
