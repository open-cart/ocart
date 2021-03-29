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
                <span class="font-bold text-2xl">{{ $data->price }}</span>
                &nbsp;
                <span class="text-sm font-semibold">đ</span>
            </div>
        </div>
    </a>

@endif
