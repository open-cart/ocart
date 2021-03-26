@props(['data' => null])
@if($data)
    <a href="/product/{{ $data->id }}" class="h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-60 overflow-hidden">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://themezhub.net/resido-live/resido/assets/img/p-2.jpg" alt="">
        </div>
        <div class="p-4">
            <span class="inline-block py-1 leading-none bg-orange-200 text-gray-500 rounded-full font-semibold uppercase tracking-wide text-xs">
                {{ Arr::get($data->categories->first(), 'name') }}
            </span>
            <h2 class="mt-2 mb-2 font-bold">{{ $data->name }}</h2>
            <p class="text-sm text-gray-500 line-clamp-3">{{ $data->description }}</p>
            <div class="mt-3 flex items-center text-blue-600">
                <span class="font-bold text-2xl">{{ $data->price }}</span>
                &nbsp;
                <span class="text-sm font-semibold">đ</span>
            </div>
        </div>
        <div class="p-4 border-t text-sm text-gray-500">
            <span class="flex items-center">
                <x-theme::icons.marker/> 210 Zirak Road, Canada
            </span>
        </div>
        <div class="p-4 flex items-center text-sm text-gray-600">

            <x-theme::icons.star class="text-yellow-500"/>
            <x-theme::icons.star class="text-yellow-500"/>
            <x-theme::icons.star class="text-yellow-500"/>
            <x-theme::icons.star class="text-yellow-500"/>
            <x-theme::icons.star class="text-gray-400"/>
            <span class="ml-2">34 Bewertungen</span></div>
    </a>

@endif
