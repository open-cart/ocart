@props(['data' => null])
@if($data)
    <a href="/product/{{ $data->id }}" class="h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-60 overflow-hidden">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ TnMedia::url(head($data->images)) }}" alt="">
        </div>
        <div class="p-4">
            <span class="inline-block py-1 leading-none bg-orange-200 text-gray-500 rounded-full font-semibold uppercase tracking-wide text-xs">
                {{ Arr::get($data->categories->first(), 'name') }}
            </span>
            <h2 class="mt-2 mb-2 font-bold">{{ $data->name }}</h2>
            <p class="text-sm text-gray-500 line-clamp-3">{!! $data->description !!}</p>
            <div class="mt-3 flex items-center text-blue-600">
                @if($data->price >= 1)
                    <span class="font-bold text-2xl">{{ $data->price }}</span>
                    &nbsp;
                    <span class="text-sm font-semibold">đ</span>
                @else
                    <span class="font-bold text-2xl">Liên hệ</span>
                @endif
                @if($data->price >= 1 && $data->price < $data->price_sell)
                    <span class="font-medium line-through text-gray-300 text-lg ml-4">{{ $data->price_sell }}</span>
                    &nbsp;
                    <span class="text-sm font-semibold text-gray-300 line-through">đ</span>
                @endif
            </div>
        </div>
        <div class="p-4 border-t text-sm text-gray-500">
            <span class="flex items-center">
                <x-theme::icons.marker/> {{ $data->address }}
            </span>
        </div>
        <div class="p-4 flex items-center text-sm text-gray-600">

            <x-theme::icons.star class="text-yellow-500"/>
            <x-theme::icons.star class="text-yellow-500"/>
            <x-theme::icons.star class="text-yellow-500"/>
            <x-theme::icons.star class="text-yellow-500"/>
            <x-theme::icons.star class="text-gray-400"/>
            <span class="ml-2 ">34 Đánh giá</span></div>
    </a>

@endif
