@props(['data' => null])
@if($data)
    <div class="relative group h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <a href="{!! $data->url !!}">
            <img
                class="h-full w-full object-cover lg:absolute lozad"
                data-src="{{ TnMedia::getImageUrl(Arr::first($data->images), 'large', asset('/images/no-image.jpg')) }}"
                src="{{ asset('/images/no-image.jpg') }}"
                alt="{{ $data->name }}"
            >
        </a>

        <div class="lg:opacity-0 group-hover:opacity-100 transition duration-500 ease-in-out absolute bottom-0 right-0 top-0 bg-white bg-opacity-90 w-1/2 p-2 md:p-3" >
            <a
                href="{!! !empty($data->slug) ? $data->url : 'javascript:void(0)' !!}"
            >
                <h3 class="text-xs md:text-base font-semibold text-gray-700 line-clamp-4 hover:text-blue-700 mt-4">{{ $data->name }}</h3>
            </a>

{{--            @if(is_active_plugin('ec_review'))--}}
{{--                @php--}}
{{--                    $avg = $data->reviews_avg; //get_average_star_of_product($data->id);--}}
{{--                @endphp--}}
{{--                <div class="flex items-center my-1 md:mt-2 md: mb-0">--}}
{{--                    @for($i=0; $i < 5; $i++)--}}
{{--                        <x-theme::icons.star :active="$i < $avg"/>--}}
{{--                    @endfor--}}
{{--                </div>--}}
{{--            @endif--}}

            <div class="block text-sm text-gray-500 line-clamp-5 mt-2">{!! $data->description !!}</div>
            <div class="flex justify-between items-center md:mt-2">
                @if(!empty($data->sell_price) && $data->sell_price > 0)
                    <div class="flex text-red-600">
                        <span class="font-bold text-sm md:text-base">{{ format_price($data->sell_price) }}</span>
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

@endif
