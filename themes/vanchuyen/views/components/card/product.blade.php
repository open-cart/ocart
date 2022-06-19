@props(['data' => null, 'ratio' => 1])
@if($data)
    <div class="h-full block shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <a
            href="{!! $data->url !!}"
            class="effect"
            style="padding-bottom: calc( {{ $ratio }} * 100% );"
        >
            <img
                class="w-full h-full object-cover absolute lozad"
                data-src="{{ TnMedia::getImageUrl(Arr::first($data->images) . '?w=200', asset('/images/no-image.jpg')) }}"
                data-srcset="{{ TnMedia::getImageUrl(Arr::first($data->images) . '?w=200', asset('/images/no-image.jpg')) }} 1000w, {{ TnMedia::getImageUrl(Arr::first($data->images), 'medium', asset('/images/no-image.jpg')) }} 2000w"
                src="{{ asset('/images/no-image.jpg') }}"
                alt="{{ $data->name }}"
            >
        </a>
        <div class="p-2 md:p-3">
            <a href="{!! $data->url !!}" class="hover:text-blue-700">
                <h3 class="text-xs md:text-base font-semibold text-gray-700 line-clamp-2">{{ $data->name }}</h3>
            </a>

            <div class="flex justify-between items-center">
                @if(!empty($data->sell_price) && $data->sell_price > 0)
                    <div class="inline-flex items-center">
                        <span class="font-bold text-sm md:text-base">
                            {{ format_price($data->sell_price) }}
                        </span>
                        @if($data->price > $data->sell_price)
                            <span class="font-bold text-white bg-red-500 rounded-sm px-1 text-xs ml-2">
                                -{{ format_price(100 - ($data->sell_price/$data->price)*100, '%') }}%
                            </span>
                        @endif
                    </div>
                @else
                    <div class="flex text-red-600">
                        <span class="font-bold text-sm md:text-base">Liên hệ</span>
                    </div>
                @endif
                <button onclick="addToCart({{ $data->id, $data->slug }})" class="hidden md:block flex text-blue-600 p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:text-green-500" title="Thêm vào giỏ hàng">
                    <x-theme::icons.shopping-cart class="w-7"/>
                </button>

            </div>
        </div>

    </div>

@endif
