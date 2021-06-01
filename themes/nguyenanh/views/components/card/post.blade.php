@props(['data' => null])
@if($data)
    <a href="/post/{{ $data->slug }}" class="h-full block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-32 md:pb-60 overflow-hidden">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ TnMedia::url($data->image ?? '/images/no-image.jpg') }}" alt="{{ $data->name }}">
        </div>
        <div class="p-2 md:p-4">
            <h3 class="md:mb-2 text-xs md:text-base font-bold line-clamp-2">{{ $data->name }}</h3>
            <div class="text-xs md:text-sm text-gray-500 line-clamp-2 md:line-clamp-3">{!! $data->description !!}</div>
        </div>
    </a>
@endif
