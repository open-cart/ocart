@props(['data' => null])
@if($data)
    <div class="h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-60 overflow-hidden">
            <a href="/product/{{ $data->slug }}">
                <img class="absolute inset-0 h-full w-full object-cover" src="{{ TnMedia::url(empty($data->images) ? '/images/no-image.jpg' : head($data->images)) }}" alt="">
            </a>
        </div>
        <div class="p-4">
            <a href=/product-category/{{ Arr::get($data->categories->first(), 'slug') }}" class="inline-block leading-none text-gray-500 tracking-wide text-xs hover:text-blue-700">
                {{ Arr::get($data->categories->first(), 'name') }}
            </a>
            <a href="/product/{{ $data->slug }}" class="hover:text-blue-700">
                <h3 class="mb-2 font-bold">{{ $data->name }}</h3>
            </a>
            <div class="text-sm text-gray-500 line-clamp-3">{!! $data->description !!}</div>
            <div class="flex justify-between items-center mt-3">
                <div class="flex text-red-600">
                    <span class="font-bold text-2xl">{{ format_price($data->sell_price) }}</span>
                    &nbsp;
                    <span class="text-sm font-semibold">đ</span>
                    @if($data->price > $data->sell_price)
                        <span class="font-medium line-through text-gray-300 text-lg ml-4">{{ format_price($data->price) }}</span>
                        &nbsp;
                        <span class="text-sm font-semibold text-gray-300 line-through">đ</span>
                    @endif
                </div>
                <button onclick="addToCart({{ $data->id }})" class="flex text-blue-600 p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:text-green-500" title="Thêm vào giỏ hàng">
                    <x-theme::icons.shopping-cart class="w-7"/>
                </button>

            </div>
        </div>
        @if($data->address)
            <div class="p-4 border-t text-sm text-gray-500">
                <span class="flex items-center">
                    <x-theme::icons.marker/> {{ $data->address }}
                </span>
            </div>
        @endif

        <div class="flex justify-between p-4 border-t items-center text-sm text-gray-600">
            <div class="flex">
                <x-theme::icons.star class="text-yellow-500"/>
                <x-theme::icons.star class="text-yellow-500"/>
                <x-theme::icons.star class="text-yellow-500"/>
                <x-theme::icons.star class="text-yellow-500"/>
                <x-theme::icons.star class="text-gray-400"/>
                <span class="ml-1">(34)</span>
            </div>
            @if($data->created_at)
                <div class="flex">
                    <x-theme::icons.calendar/>
                    <span class="ml-1">{{ date_format($data->created_at, "d/m/Y") }}</span>
                </div>
            @endif
        </div>
    </div>

@endif